<?php

namespace App\Http\Controllers;

use App\Models\Date;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function index (Request $request)
    {
        $year = 2022;
        $dates = Date::pluck('number', 'date');
        $filterDates = Date::query();
        if ($request->from_date) {
            $filterDates->where('date', '>=', $request->from_date);
        }
        if ($request->to_date) {
            $filterDates->where('date', '<=', $request->to_date);
        }
        $filterDates = $filterDates->pluck('number');
        $numbers = [];
        foreach ($filterDates as $filterDate) {
            $numbers[$filterDate] = (@$numbers[$filterDate] ?? 0) + 1;
        }
        $months = [];
        for($i = 1; $i < 13; $i++) {
            $months[$i] = Carbon::createFromDate($year, $i)->daysInMonth;
        }
        if ($request->ajax()) {
            return response()->json(['view' => view('date_table', compact( 'numbers'))->render()]);
        }
        return view('date', compact('dates', 'numbers', 'months', 'year'));
    }

    public function store (Request $request)
    {
        $data = [];
        foreach ($request->days as $key => $day) {
            if($day) {
                $data[] = [
                    'date' => $key,
                    'number' => $day,
                ];
            }
        }
        Date::where('id', '>=', 1)->delete();
        Date::insert($data);
        return redirect()->back();
    }
}
