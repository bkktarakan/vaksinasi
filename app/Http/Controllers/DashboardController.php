<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Vaccine;
use App\Models\VaccinationRecord;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = \Carbon\Carbon::now()->month;
        $currentYear = \Carbon\Carbon::now()->year;

        $recordQuery = VaccinationRecord::whereMonth('vaccination_date', $currentMonth)
            ->whereYear('vaccination_date', $currentYear);
        
        $vaccineQuery = Vaccine::query();
        $recentRecordQuery = VaccinationRecord::with(['patient', 'vaccine']);

        if (auth()->user()->wilker !== 'Kantor Induk') {
            $userId = auth()->id();
            $recordQuery->where('user_id', $userId);
            $vaccineQuery->where('user_id', $userId);
            $recentRecordQuery->where('user_id', $userId);
        }

        $totalPatientsThisMonth = $recordQuery->count();
        $vaccines = $vaccineQuery->get();
        
        $recentRecords = $recentRecordQuery
            ->orderBy('vaccination_date', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('totalPatientsThisMonth', 'vaccines', 'recentRecords'));
    }
}
