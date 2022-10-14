<?php

namespace App\Helpers;

use Carbon\Carbon;

class RoomsHelper
{
    static function buildMatrix($fileContent): array
    {
        $matrix = [];
        $cleanContent = explode("\n", $fileContent);
        foreach ($cleanContent as $indexRaw => $raws) {
            $cleanRaw = trim($raws);
            for($i = 0; $i < strlen($cleanRaw); $i++) {
                $matrix[$indexRaw][$i] = $raws[$i];
            }
        }

        return $matrix;
    }

    public function down($col, $raw, $matrix, $placeLight)
    {
        $counter = 0;
        for ($i = $col + 1; $i < 100; $i++) {
            if (array_key_exists($i, $matrix)) {
                if ($matrix[$i][$raw] == 1)
                    break;
                elseif ($matrix[$i][$raw] == 2 || $matrix[$i][$raw] == 3)
                    continue;
                elseif ($matrix[$i][$raw] == 0) {
                    if ($placeLight)
                        $matrix[$i][$raw] = 3;
                    $counter++;
                }
            } else {
                break;
            }
        }
        if ($placeLight)
            return $matrix;
        return $counter;
    }

    public function up($col, $raw, $matrix, $placeLight)
    {
        $counter = 0;
        for ($i = $raw - 1; $i >= 0; $i--) {
            if (array_key_exists($i, $matrix)) {
                if ($matrix[$col][$i] == 1)
                    break;
                elseif ($matrix[$col][$i] == 2 || $matrix[$col][$i] == 3)
                    continue;
                elseif ($matrix[$col][$i] == 0) {
                    if ($placeLight)
                        $matrix[$col][$i] = 3;
                    $counter++;
                }
            } else {
                break;
            }
        }
        if ($placeLight)
            return $matrix;
        return $counter;
    }

    public function right($col, $raw, $matrix, $placeLight)
    {
        $counter = 0;
        for ($i = $raw + 1; $i < 100; $i++) {
            if (array_key_exists($i, $matrix[$col])) {
                if ($matrix[$col][$i] == 1)
                    break;
                elseif ($matrix[$col][$i] == 2 || $matrix[$col][$i] == 3)
                    continue;
                elseif ($matrix[$col][$i] == 0) {
                    if ($placeLight) {
                        $matrix[$col][$i] = 3;
                    }
                    $counter++;
                }
            } else {
                break;
            }
        }
        if ($placeLight)
            return $matrix;
        return $counter;
    }

    public function left($col, $raw, $matrix, $placeLight)
    {
        $counter = 0;
        for ($i = $col - 1; $i >= 0; $i--) {
            if (array_key_exists($i, $matrix[$i])) {
                if ($matrix[$i][$raw] == 1)
                    break;
                elseif ($matrix[$i][$raw] == 2 || $matrix[$i][$raw] == 3)
                    continue;
                elseif ($matrix[$i][$raw] == 0) {
                    if ($placeLight) {
                        $matrix[$i][$raw] = 3;
                    }
                    $counter++;
                }
            } else {
                break;
            }
        }
        if ($placeLight)
            return $matrix;
        return $counter;
    }

    public function setBulbAndPlaceLight($originalmatrix, $betterBulbs) {
        foreach ($betterBulbs as $coo => $bulb) {
            $indexes = explode('-', $coo);
            $col = (int) $indexes[0];
            $raw = (int) $indexes[1];
            $originalmatrix[$col][$raw] = 2;

            $originalmatrix = self::down($col, $raw, $originalmatrix, true);
            $originalmatrix = self::up($col, $raw, $originalmatrix, true);
            $originalmatrix = self::right($col, $raw, $originalmatrix, true);
            $originalmatrix = self::left($col, $raw, $originalmatrix, true);

            break;
        }

        return $originalmatrix;
    }

    public function getTotalFieldsLighted($downFields, $rightFields, $upFields, $leftFields) {
        return ($downFields + $rightFields + $upFields + $leftFields);
    }
}
