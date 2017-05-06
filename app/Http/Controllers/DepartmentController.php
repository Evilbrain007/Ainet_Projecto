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

        if ($bwCompletedPrints === 0 && $coloredCompletedPrints === 0) {
            $statistics['bwColoredPrintsRatio'] = 'N/D';
            $statistics['coloredBWPrintsRatio'] = 'N/D';
        } else {
            if ($coloredCompletedPrints === 0 && $coloredCompletedPrints > 0) {
                $statistics['bwColoredPrintsRatio'] = '100 %';
            } else {
                $ratio = $bwCompletedPrints / $coloredCompletedPrints * 100;
                $statistics['bwColoredPrintsRatio'] = "$ratio" . ' %';
            }
            if ($bwCompletedPrints === 0 && $coloredCompletedPrints > 0) {
                $statistics['coloredBWPrintsRatio'] = '100 %';
            } else {
                $ratio = $coloredCompletedPrints / $bwCompletedPrints * 100;
                $statistics['coloredBWPrintsRatio'] = "$ratio" . ' %';
            }
        }

        $today = Carbon::today();
        $statistics['totalPrintsToday'] = DB::table('users')
            ->where('department_id', $department->id)
            ->join('requests', 'requests.owner_id', '=', 'users.id')
            ->whereDate('closed_date', $today)
            ->count();

        $now = Carbon::now();
        $currentMonth = $now->month;
        $printAvgCurrentMonth= DB::table('users')
            ->where('department_id', $department->id)
            ->join('requests', 'requests.owner_id', '=', 'users.id')
            ->whereMonth('closed_date', $currentMonth)
            ->count();
        $statistics['printAvgCurrentMonth'] = $printAvgCurrentMonth/($now->daysInMonth);

        return view('departments/details', compact('title', 'department', 'statistics'));
    }
}
