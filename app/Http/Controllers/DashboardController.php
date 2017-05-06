<?php

namespace App\Http\Controllers;

use App\Department;
use App\PrintRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function getIndex(Request $request)
    {
        if ($request->userOrder === 'desc') {
            $userOrder = 'desc';
            $selectedUserAsc = false;
        } else {
            $userOrder = 'asc';
            $selectedUserAsc = true;
        }

        $title = "Printit!";

        $users = User::orderBy('name', $userOrder)->paginate(8);
        $departments = Department::orderBy('name', 'asc')->get();

        $statistics = [];
        $completedPrints = PrintRequest::whereNotNull('closed_user_id')->get();
        $statistics['totalPrints'] = $completedPrints->count();
        $bwCompletedPrints = $completedPrints->where('colored', false)->count();
        $coloredCompletedPrints = $completedPrints->where('colored', true)->count();

        if ($statistics['totalPrints'] === 0) {
            $statistics['bwColoredPrintsRatio'] = 'N/D';
            $statistics['coloredBWPrintsRatio'] = 'N/D';
        } else {
            $ratioColor = $bwCompletedPrints / $statistics['totalPrints'] * 100;
            $statistics['bwColoredPrintsRatio'] = "$ratioColor" . ' %';
            $ratioBW = $coloredCompletedPrints / $statistics['totalPrints'] * 100;
            $statistics['coloredBWPrintsRatio'] = "$ratioBW" . ' %';
        }

        $now = Carbon::now();
        $today = $now->toDateString();
        $statistics['totalPrintsToday'] = PrintRequest::whereDate('closed_date', $today)->count();

        $currentMonth = $now->month;

        $totalPrintsCurrentMonth = PrintRequest::whereMonth('closed_date', $currentMonth)->count();
        $statistics['printAvgCurrentMonth'] = $totalPrintsCurrentMonth/($now->daysInMonth);

        foreach ($departments as $department) {
            $department->totalPrints = 0;
            $departmentUsers = User::where('department_id', $department->id)->get();
            foreach ($departmentUsers as $user) {
                $n = PrintRequest::whereNotNull('closed_date')->where('owner_id', $user->id)->count();
                $department->totalPrints += $n;
            }
        }

        return view('dashboard', compact('title', 'users', 'departments', 'statistics', 'selectedUserAsc'));
    }
}
