<?php

namespace App\Http\Controllers;

use App\Services\CashRealService;
use Illuminate\Http\Request;

class CashRealController extends Controller
{
    public function home()
    {
        return view('cashreal.home');
    }

    public function result(Request $request, CashRealService $service)
    {
        $request->validate([
            'salary' => 'required|numeric|min:1',
        ]);

        $salary = $request->salary;
        $wantHouse = $request->has('house');
        $wantCar = $request->has('car');

        $data = $service->calculate($salary, $wantHouse, $wantCar);

        return view('cashreal.result', compact('data', 'wantHouse', 'wantCar'));
    }
}
