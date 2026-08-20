<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Vaccine;
use App\Models\VaccinationRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $query = Patient::query();
        if (auth()->user()->wilker !== 'Kantor Induk') {
            $query->where('user_id', auth()->id());
        }
        $patients = $query->orderBy('created_at', 'desc')->get();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        $query = Vaccine::where('stock', '>', 0);
        if (auth()->user()->wilker !== 'Kantor Induk') {
            $query->where('user_id', auth()->id());
        }
        $vaccines = $query->get();
        return view('patients.create', compact('vaccines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barcode_number' => 'required|string|max:255',
            'e_icv_issue_date' => 'required|date',
            'passport_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'vaccine_ids' => 'required|array',
            'vaccine_ids.*' => 'exists:vaccines,id',
            'vaccination_date' => 'required|date',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'hcg_done' => 'nullable|boolean',
            'hcg_result' => 'nullable|string|in:Positif,Negatif',
            'officer_name' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            // Find or Create Patient based on Passport
            $patient = Patient::updateOrCreate(
                ['passport_number' => $request->passport_number],
                [
                    'user_id' => auth()->id(), // tie patient to wilker
                    'barcode_number' => $request->barcode_number,
                    'e_icv_issue_date' => $request->e_icv_issue_date,
                    'name' => $request->name,
                    'place_of_birth' => $request->place_of_birth,
                    'date_of_birth' => $request->date_of_birth,
                    'gender' => $request->gender,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'email' => $request->email,
                ]
            );

            // Loop through each selected vaccine
            foreach ($request->vaccine_ids as $vaccine_id) {
                // Verify the vaccine belongs to the user or it's Kantor Induk
                $vaccine = Vaccine::find($vaccine_id);
                if (auth()->user()->wilker !== 'Kantor Induk' && $vaccine->user_id !== auth()->id()) {
                    continue; // Skip if they try to hack the form to use another wilker's vaccine
                }

                // Create Record
                VaccinationRecord::create([
                    'user_id' => auth()->id(),
                    'patient_id' => $patient->id,
                    'vaccine_id' => $vaccine_id,
                    'vaccination_date' => $request->vaccination_date,
                    'hcg_done' => $request->has('hcg_done'),
                    'hcg_result' => $request->has('hcg_done') ? $request->hcg_result : null,
                    'officer_name' => $request->officer_name,
                ]);

                // Deduct Stock
                $vaccine->stock -= 1;
                $vaccine->save();
            }
        });

        return redirect()->route('dashboard')->with('success', 'Data pasien dan vaksinasi berhasil disimpan.');
    }

    public function show(Patient $patient)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $patient->user_id !== auth()->id()) {
            abort(403);
        }
        $records = $patient->records()->with('vaccine')->orderBy('vaccination_date', 'desc')->get();
        $existingVaccineIds = $records->pluck('vaccine_id')->toArray();
        
        $query = Vaccine::where('stock', '>', 0)
                        ->whereNotIn('id', $existingVaccineIds);
        
        if (auth()->user()->wilker !== 'Kantor Induk') {
            $query->where('user_id', auth()->id());
        }
        $vaccines = $query->get();

        return view('patients.show', compact('patient', 'records', 'vaccines'));
    }

    public function edit(Patient $patient)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $patient->user_id !== auth()->id()) {
            abort(403);
        }
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $patient->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'barcode_number' => 'required|string|max:255',
            'e_icv_issue_date' => 'required|date',
            'passport_number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
        ]);

        $patient->update([
            'barcode_number' => $request->barcode_number,
            'e_icv_issue_date' => $request->e_icv_issue_date,
            'passport_number' => $request->passport_number,
            'name' => $request->name,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
        ]);

        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Patient $patient)
    {
        if (auth()->user()->wilker !== 'Kantor Induk' && $patient->user_id !== auth()->id()) {
            abort(403);
        }
        
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
