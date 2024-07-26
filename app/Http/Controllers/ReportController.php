<?php

namespace App\Http\Controllers;

use App\Models\Technology;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function registrationReport(Request $request)
    {
        if ($request->ajax()) {
            $report = User::selectRaw('DATE(created_at) as date, reference as source, COUNT(*) as registrations')
            ->groupBy('date', 'source')
            ->orderBy('date', 'asc')
            ->get();
                
            return DataTables::of($report)
                ->addIndexColumn()
                ->rawColumns([])
                ->make(true);
        }
        return view('admin.registration_report');

    }

    public function technologyReport()
    {
        $report = Technology::withCount('users')->get();

        return view('admin.technology_report', compact('report'));
    }

    public function gmaps()
    {
    	$locations = User::select('lat','lon')->get();
    	return view('admin.maps',compact('locations'));
    }
}
