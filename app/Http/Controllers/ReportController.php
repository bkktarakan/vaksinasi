<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaccinationRecord;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function monthly(Request $request)
    {
        $month = $request->input('month', \Carbon\Carbon::now()->month);
        $year = $request->input('year', \Carbon\Carbon::now()->year);

        $query = VaccinationRecord::with(['patient', 'vaccine'])
            ->whereMonth('vaccination_date', $month)
            ->whereYear('vaccination_date', $year);

        if (auth()->user()->wilker !== 'Kantor Induk') {
            $query->where('user_id', auth()->id());
        }

        $rawRecords = $query->get();

        // Group records by patient and date so a single visit with multiple vaccines is counted as 1 patient
        $groupedRecords = $rawRecords->groupBy(function($item) {
            return $item->patient_id . '_' . $item->vaccination_date;
        });

        // Summary of vaccines
        $vaccineSummary = $rawRecords->groupBy('vaccine.name')->map->count();

        return view('reports.monthly', compact('groupedRecords', 'vaccineSummary', 'month', 'year'));
    }

    public function download(Request $request)
    {
        $month = $request->input('month', \Carbon\Carbon::now()->month);
        $year = $request->input('year', \Carbon\Carbon::now()->year);

        $query = VaccinationRecord::with(['patient', 'vaccine'])
            ->whereMonth('vaccination_date', $month)
            ->whereYear('vaccination_date', $year);

        if (auth()->user()->wilker !== 'Kantor Induk') {
            $query->where('user_id', auth()->id());
        }

        $rawRecords = $query->get();

        $groupedRecords = $rawRecords->groupBy(function($item) {
            return $item->patient_id . '_' . $item->vaccination_date;
        });

        $fileName = 'Laporan_Vaksinasi_' . auth()->user()->wilker . '_' . $month . '_' . $year . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No', 'Tanggal', 'No. Barcode', 'No. Paspor', 'Nama Pasien', 'Jenis Kelamin', 'Tempat & Tgl Lahir', 'Jenis Vaksin', 'Hasil HCG', 'Nama Petugas'];

        $callback = function() use($groupedRecords, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            $i = 1;
            foreach ($groupedRecords as $group) {
                $firstRecord = $group->first();
                $vaccineNames = $group->map(function($record) {
                    return $record->vaccine->name;
                })->implode(', ');

                $row = [
                    $i,
                    \Carbon\Carbon::parse($firstRecord->vaccination_date)->format('Y-m-d'),
                    $firstRecord->patient->barcode_number ?? '-',
                    $firstRecord->patient->passport_number,
                    $firstRecord->patient->name,
                    $firstRecord->patient->gender,
                    $firstRecord->patient->place_of_birth . ', ' . \Carbon\Carbon::parse($firstRecord->patient->date_of_birth)->format('Y-m-d'),
                    $vaccineNames,
                    $firstRecord->hcg_done ? $firstRecord->hcg_result : '-',
                    $firstRecord->officer_name ?? '-'
                ];

                fputcsv($file, $row);
                $i++;
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
