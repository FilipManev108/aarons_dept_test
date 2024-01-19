<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shift;
use Illuminate\Http\Request;

class UserController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::withCount('shifts')->withSum('shifts', 'hours')->paginate(10)->withQueryString();

        // dd($users);
        return view('employees.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        $baseQuery =
        Shift::where('user_id', '=', $user->id)
        ->where('status_id', '=', 1);

        $lastFive =
            $baseQuery->clone()
            ->with('status', 'user', 'shiftType', 'company')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        $average = $baseQuery->clone()
            ->selectRaw('(SUM(`total_pay`) / SUM(`hours`)) AS pay_per_hour')
            ->selectRaw('(SUM(`total_pay`) / COUNT(*)) AS total_pay')
            ->get()
            ->toArray();
        $average = $average[0];

        return view('employees.show', compact('user', 'average', 'lastFive'));
    }
}
