<?php

namespace App\Http\Controllers;

use App\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function detail(Department $id)
    {
        $department = $id;
        $title = $department->name;

        $printRequests = DB::table('users')
            ->where('department_id', $department->id)
            ->join('requests', 'requests.owner_id', '=', 'users.id')
            ->whereNotNull('closed_user_id')
            ->get();


        $statistics = [];
        $statistics['totalPrints'] = $printRequests->count();
        $bwCompletedPrints = $printRequests->where('colored', false)->count();
        $coloredCompletedPrints = $printRequests->where('colored', true)->count();

        if ($statistics['totalPrints'] === 0) {
            $statistics['bwColoredPrintsRatio'] = 'N/D';
            $statistics['coloredBWPrintsRatio'] = 'N/D';
        } else {
            $ratioColor = $bwCompletedPrints / $statistics['totalPrints'] * 100;
            $statistics['bwColoredPrintsRatio'] = "$ratioColor" . ' %';
            $ratioBW = $coloredCompletedPrints / $statistics['totalPrints'] * 100;
            $statistics['coloredBWPrintsRatio'] = "$ratioBW" . ' %';
        }

        $today = Carbon::today();
        $statistics['totalPrintsToday'] = DB::table('users')
            ->where('department_id', $department->id)
            ->join('requests', 'requests.owner_id', '=', 'users.id')
            ->whereDate('closed_date', $today)
            ->count();

        $now = Carbon::now();
        $currentMonth = $now->month;
        $printAvgCurrentMonth = DB::table('users')
            ->where('department_id', $department->id)
            ->join('requests', 'requests.owner_id', '=', 'users.id')
            ->whereMonth('closed_date', $currentMonth)
            ->count();
        $statistics['printAvgCurrentMonth'] = $printAvgCurrentMonth / ($now->daysInMonth);

        return view('departments/details', compact('title', 'department', 'statistics'));
    }
}
