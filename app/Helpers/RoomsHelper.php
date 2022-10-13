<?php

namespace App\Helpers;

use Carbon\Carbon;

class RoomsHelper
{
    static function buildMatrix(): array
    {
        $matrix = [];
        $matrix[0][0] = 0; $matrix[0][1] = 0; $matrix[0][2] = 0; $matrix[0][3] = 1; $matrix[0][4] = 0; $matrix[0][5] = 1; $matrix[0][6] = 1; $matrix[0][7] = 1;
        $matrix[1][0] = 0; $matrix[1][1] = 1; $matrix[1][2] = 0; $matrix[1][3] = 0; $matrix[1][4] = 0; $matrix[1][5] = 0; $matrix[1][6] = 0; $matrix[1][7] = 0;
        $matrix[2][0] = 0; $matrix[2][1] = 1; $matrix[2][2] = 0; $matrix[2][3] = 0; $matrix[2][4] = 0; $matrix[2][5] = 1; $matrix[2][6] = 1; $matrix[2][7] = 1;
        $matrix[3][0] = 0; $matrix[3][1] = 1; $matrix[3][2] = 1; $matrix[3][3] = 1; $matrix[3][4] = 1; $matrix[3][5] = 0; $matrix[3][6] = 0; $matrix[3][7] = 0;
        $matrix[4][0] = 0; $matrix[4][1] = 1; $matrix[4][2] = 0; $matrix[4][3] = 0; $matrix[4][4] = 1; $matrix[4][5] = 0; $matrix[4][6] = 0; $matrix[4][7] = 0;
        $matrix[5][0] = 0; $matrix[5][1] = 1; $matrix[5][2] = 0; $matrix[5][3] = 0; $matrix[5][4] = 1; $matrix[5][5] = 0; $matrix[5][6] = 1; $matrix[5][7] = 0;
        $matrix[6][0] = 0; $matrix[6][1] = 1; $matrix[6][2] = 0; $matrix[6][3] = 1; $matrix[6][4] = 1; $matrix[6][5] = 0; $matrix[6][6] = 1; $matrix[6][7] = 0;
        $matrix[7][0] = 0; $matrix[7][1] = 0; $matrix[7][2] = 0; $matrix[7][3] = 0; $matrix[7][4] = 1; $matrix[7][5] = 0; $matrix[7][6] = 0; $matrix[7][7] = 0;
        $matrix[8][0] = 0; $matrix[8][1] = 1; $matrix[8][2] = 1; $matrix[8][3] = 0; $matrix[8][4] = 1; $matrix[8][5] = 1; $matrix[8][6] = 0; $matrix[8][7] = 1;
        $matrix[9][0] = 0; $matrix[9][1] = 0; $matrix[9][2] = 0; $matrix[9][3] = 0; $matrix[9][4] = 1; $matrix[9][5] = 0; $matrix[9][6] = 0; $matrix[9][7] = 0;
        $matrix[10][0]= 1; $matrix[10][1]= 0; $matrix[10][2]= 0; $matrix[10][3]= 1; $matrix[10][4]= 0; $matrix[10][5]= 0; $matrix[10][6]= 1; $matrix[10][7]= 1;
        $matrix[11][0]= 0; $matrix[11][1]= 0; $matrix[11][2]= 1; $matrix[11][3]= 0; $matrix[11][4]= 0; $matrix[11][5]= 0; $matrix[11][6]= 0; $matrix[11][7]= 0;

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
        for ($i = $col - 1; $i < 0; $i--) {
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
        for ($i = $raw - 1; $i < 0; $i--) {
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
