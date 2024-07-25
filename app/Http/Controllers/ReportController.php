<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function registrationReport()
    {
        $report = User::selectRaw('DATE(created_at) as date, technology_ids, COUNT(*) as registrations')
        ->groupBy('date', 'technology_ids')
        ->orderBy('date', 'asc')
        ->get();

        return view('admin.registration_report', compact('report'));
    }

    public function technologyReport()
    {
        $report = Technology::withCount('users')->get();

        return view('admin.technology_report', compact('report'));
    }


}
