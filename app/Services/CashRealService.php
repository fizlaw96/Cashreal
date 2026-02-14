<?php

namespace App\Services;

class CashRealService
{
    public function calculate($salary, $wantHouse, $wantCar, $isMarried = false)
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

        $needsItems = [
            ['label' => 'Perumahan dan utiliti', 'weight' => 35],
            ['label' => 'Makanan dan keperluan harian', 'weight' => 30],
            ['label' => 'Pengangkutan', 'weight' => 20],
            ['label' => 'Insurans dan kesihatan', 'weight' => 15],
        ];

        if ($isMarried) {
            $needsItems = [
                ['label' => 'Perumahan dan utiliti', 'weight' => 30],
                ['label' => 'Makanan dan keperluan harian', 'weight' => 25],
                ['label' => 'Pengangkutan', 'weight' => 20],
                ['label' => 'Insurans dan kesihatan', 'weight' => 10],
                ['label' => 'Nafkah isteri', 'weight' => 15],
            ];
        }

        $needsBreakdown = $this->buildBreakdown($needs, $needsItems);

        $wantsBreakdown = $this->buildBreakdown($wants, [
            ['label' => 'Langganan digital', 'weight' => 20],
            ['label' => 'Hobi dan hiburan', 'weight' => 30],
            ['label' => 'Travel dan gaya hidup', 'weight' => 30],
            ['label' => 'Makan luar', 'weight' => 20],
        ]);

        $savingsBreakdown = $this->buildBreakdown($savings, [
            ['label' => 'Dana kecemasan', 'weight' => 45],
            ['label' => 'Persaraan', 'weight' => 25],
            ['label' => 'Pelaburan', 'weight' => 20],
            ['label' => 'Matlamat jangka panjang', 'weight' => 10],
        ]);

        $score = 100;

        if ($savingsRatio < 0.15) {
            $score -= 20;
        }
        if ($wantsRatio > 0.30) {
            $score -= 10;
        }

        $isLowSalary = $salary < 2500;

        if ($isLowSalary) {
            $score -= 20;
            $notes[] = 'Gaji semasa masih kecil. Fokus stabilkan simpanan dan dana kecemasan, tangguhkan beli rumah dan kereta dahulu.';
        } else {
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
        }

        if ($savings < ($salary * 0.20)) {
            $notes[] = 'Cuba kekalkan simpanan sekurang-kurangnya 20%.';
        }

        if ($salary >= 15000) {
            $notes[] = 'Gaji anda tinggi. Cadangan bonus: salurkan 1%-2% untuk sedekah kepada creator website ini.';
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
            'needsBreakdown' => $needsBreakdown,
            'wantsBreakdown' => $wantsBreakdown,
            'savingsBreakdown' => $savingsBreakdown,
        ];
    }

    private function buildBreakdown($total, array $items): array
    {
        $result = [];
        $remainingAmount = (float) $total;
        $remainingWeight = array_sum(array_column($items, 'weight'));
        $lastIndex = count($items) - 1;

        foreach ($items as $index => $item) {
            if ($index === $lastIndex || $remainingWeight <= 0) {
                $amount = max(0, $remainingAmount);
            } else {
                $amount = round($total * ($item['weight'] / 100));
                $amount = min(max(0, $amount), $remainingAmount);
            }

            $remainingAmount -= $amount;
            $remainingWeight -= $item['weight'];

            $result[] = [
                'label' => $item['label'],
                'percent' => $item['weight'],
                'amount' => $amount,
            ];
        }

        return $result;
    }
}
