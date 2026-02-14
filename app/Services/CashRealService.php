<?php

namespace App\Services;

class CashRealService
{
    public function calculate($salary, $wantHouse, $wantCar)
    {
        $salary = max(0, $salary);

        if ($salary < 2500) {
            $needsRatio = 0.60;
            $wantsRatio = 0.20;
            $savingsRatio = 0.20;
            $mode = 'Low Income Mode (60/20/20)';
        } else {
            $needsRatio = 0.55;
            $wantsRatio = 0.25;
            $savingsRatio = 0.20;
            $mode = 'Standard Mode (55/25/20)';
        }

        $needs = round($salary * $needsRatio);
        $wants = round($salary * $wantsRatio);
        $savings = round($salary * $savingsRatio);

        $houseMin = round($salary * 0.25);
        $houseMax = round($salary * 0.30);

        $carMin = round($salary * 0.10);
        $carMax = round($salary * 0.15);

        $notes = [];
        $score = 100;

        if ($savingsRatio < 0.15) {
            $score -= 20;
        }
        if ($wantsRatio > 0.30) {
            $score -= 10;
        }

        if ($wantHouse) {
            if ($needs < $houseMax) {
                $score -= 15;
                $notes[] = "Keperluan mungkin ketat untuk ansuran rumah selamat RM{$houseMin}-RM{$houseMax}.";
            } else {
                $notes[] = "Cadangan ansuran rumah: RM{$houseMin}-RM{$houseMax}.";
            }
        }

        if ($wantCar) {
            $notes[] = "Cadangan ansuran kereta: RM{$carMin}-RM{$carMax}.";
        }

        if ($savings < ($salary * 0.20)) {
            $notes[] = 'Cuba kekalkan simpanan sekurang-kurangnya 20%.';
        }

        $score = max(0, min(100, $score));

        if ($score >= 85) {
            $level = 'Sangat Baik';
        } elseif ($score >= 70) {
            $level = 'Stabil';
        } elseif ($score >= 50) {
            $level = 'Berisiko';
        } else {
            $level = 'Kritikal';
        }

        return [
            'salary' => $salary,
            'needs' => $needs,
            'wants' => $wants,
            'savings' => $savings,
            'houseMin' => $houseMin,
            'houseMax' => $houseMax,
            'carMin' => $carMin,
            'carMax' => $carMax,
            'notes' => $notes,
            'score' => $score,
            'level' => $level,
            'mode' => $mode,
            'needsRatio' => $needsRatio,
            'wantsRatio' => $wantsRatio,
            'savingsRatio' => $savingsRatio,
        ];
    }
}
