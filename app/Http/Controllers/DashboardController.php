<?php

namespace App\Http\Controllers;

use App\Department;
use App\PrintRequest;
use App\User;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function getIndex()
    {
        $title = "Printit!";

        $users = User::all();
        $departments = Department::all();

        $statistics = [];
        $completedPrints = PrintRequest::whereNotNull('closed_user_id')->get();
        $statistics['totalPrints'] = $completedPrints->count();
        $bwCompletedPrints = $completedPrints->where('colored', false)->count();
        $coloredCompletedPrints = $completedPrints->where('colored', true)->count();

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
        $today = Carbon::now()->toDateString();
        $currentMonth = Carbon::now()->month;
        $statistics['totalPrintsToday'] = PrintRequest::whereDate('closed_date', $today)->count();
        $statistics['totalPrintsCurrentMonth'] = PrintRequest::whereMonth('closed_date', $currentMonth)->count();

        foreach ($departments as $department) {
            $department->totalPrints = 0;
            $departmentUsers = User::where('department_id', $department->id)->get();
            foreach ($departmentUsers as $user) {
                $n = PrintRequest::whereNotNull('closed_user_id')->where('owner_id', $user->id)->count();
                $department->totalPrints += $n;
            }
        }

        return view('dashboard', compact('title', 'users', 'departments', 'statistics'));
    }
}
