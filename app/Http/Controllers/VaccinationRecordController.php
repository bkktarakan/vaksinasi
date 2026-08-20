<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaccinationRecord;
use App\Models\Vaccine;
use Illuminate\Support\Facades\DB;

class VaccinationRecordController extends Controller
{
    public function store(Request $request, \App\Models\Patient $patient)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $patient->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'vaccine_id' => 'required|exists:vaccines,id',
            'vaccination_date' => 'required|date',
            'hcg_done' => 'nullable|boolean',
            'hcg_result' => 'nullable|string|in:Positif,Negatif',
            'officer_name' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $patient) {
            $vaccine = Vaccine::findOrFail($request->vaccine_id);
            if (auth()->user()->wilker !== 'Kantor Induk' && $vaccine->user_id !== auth()->id()) {
                abort(403);
            }

            VaccinationRecord::create([
                'user_id' => auth()->id(),
                'patient_id' => $patient->id,
                'vaccine_id' => $request->vaccine_id,
                'vaccination_date' => $request->vaccination_date,
                'hcg_done' => $request->has('hcg_done'),
                'hcg_result' => $request->has('hcg_done') ? $request->hcg_result : null,
                'officer_name' => $request->officer_name,
            ]);

            $vaccine->stock -= 1;
            $vaccine->save();
        });

        return redirect()->route('patients.show', $patient->id)->with('success', 'Vaksin berhasil ditambahkan.');
    }

    public function edit(VaccinationRecord $vaccinationRecord)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $vaccinationRecord->user_id !== auth()->id()) {
            abort(403);
        }

        $query = Vaccine::query();
        if (auth()->user()->wilker !== 'Kantor Induk') {
            $query->where('user_id', auth()->id());
        }
        $vaccines = $query->get();

        return view('vaccination_records.edit', compact('vaccinationRecord', 'vaccines'));
    }

    public function update(Request $request, VaccinationRecord $vaccinationRecord)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $vaccinationRecord->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'vaccine_id' => 'required|exists:vaccines,id',
            'vaccination_date' => 'required|date',
            'hcg_done' => 'nullable|boolean',
            'hcg_result' => 'nullable|string|in:Positif,Negatif',
            'officer_name' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $vaccinationRecord) {
            $oldVaccineId = $vaccinationRecord->vaccine_id;
            $newVaccineId = $request->vaccine_id;

            // If vaccine changed, update stock
            if ($oldVaccineId != $newVaccineId) {
                // Increment old
                $oldVaccine = Vaccine::find($oldVaccineId);
                if ($oldVaccine) {
                    $oldVaccine->stock += 1;
                    $oldVaccine->save();
                }

                // Decrement new
                $newVaccine = Vaccine::find($newVaccineId);
                if ($newVaccine) {
                    $newVaccine->stock -= 1;
                    $newVaccine->save();
                }
            }

            $vaccinationRecord->update([
                'vaccine_id' => $newVaccineId,
                'vaccination_date' => $request->vaccination_date,
                'hcg_done' => $request->has('hcg_done'),
                'hcg_result' => $request->has('hcg_done') ? $request->hcg_result : null,
                'officer_name' => $request->officer_name,
            ]);
        });

        return redirect()->route('patients.show', $vaccinationRecord->patient_id)->with('success', 'Riwayat vaksinasi berhasil diperbarui.');
    }

    public function destroy(VaccinationRecord $vaccinationRecord)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $vaccinationRecord->user_id !== auth()->id()) {
            abort(403);
        }

        $patientId = $vaccinationRecord->patient_id;

        DB::transaction(function () use ($vaccinationRecord) {
            // Increment stock
            $vaccine = Vaccine::find($vaccinationRecord->vaccine_id);
            if ($vaccine) {
                $vaccine->stock += 1;
                $vaccine->save();
            }

            $vaccinationRecord->delete();
        });

        return redirect()->route('patients.show', $patientId)->with('success', 'Riwayat vaksinasi berhasil dihapus.');
    }
}
