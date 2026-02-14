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
            'salary' => 'required|integer|min:1|max:100000000',
        ], [
            'salary.required' => 'Sila masukkan gaji anda.',
            'salary.integer' => 'Masukkan nombor sahaja tanpa huruf atau simbol.',
            'salary.min' => 'Gaji mesti lebih daripada 0.',
            'salary.max' => 'Nilai gaji terlalu besar.',
        ]);

        $salary = $request->salary;
        $wantHouse = $request->has('house');
        $wantCar = $request->has('car');
        $isMarried = $request->has('married');

        $data = $service->calculate($salary, $wantHouse, $wantCar, $isMarried);

        return view('cashreal.result', compact('data', 'wantHouse', 'wantCar'));
    }
}
