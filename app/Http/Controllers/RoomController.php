<?php

namespace App\Http\Controllers;

use App\Helpers\RoomsHelper;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function create() {
        return view('users.create');
    }

    /*public function downloadFile(): \Illuminate\Http\Response
    {
        $matrix = RoomsHelper::buildMatrix();

        $write = '';
        //Recorrer toda la matriz
        foreach ($matrix as $cols) {
            foreach ($cols as $value) {
                //Ir guardando el string a guardar en el archivo txt
                $write = $write."$value";
            }
            //Salto de linea
            $write = $write."\r";
        }

        $fileName = 'Matriz.txt';
        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
            'Content-Length' => strlen($write)
        ];

        return Response::make($write, 200, $headers);
    }*/

    public function store() {
        return view('users.update');
    }

    public function algorithm(Request $request) {
        $file = $request->file('txtFile');
        $originalmatrix = RoomsHelper::buildMatrix($file->getContent());
        $roomHelper = new RoomsHelper();

        for ($i = 0; $i < 50; $i++) {
            $fieldLightedByBulb = self::getBetterBulb($originalmatrix);
            //Colocar la bombilla e iluminar los espacios correspondientes
            $originalmatrix = $roomHelper->setBulbAndPlaceLight($originalmatrix, $fieldLightedByBulb);
            //Recorrer la matriz para saber si hay algun espacio sin iluminar
            $unlitField = 0;
            foreach ($originalmatrix as $cols) {
                foreach ($cols as $value) {
                    if ($value == 0)
                        $unlitField = $unlitField + 1;
                }
            }
            if ($unlitField == 0)
                break;
        }

        return view('users.details')->with(['matrix' => $originalmatrix]);
    }

    public function getBetterBulb($originalmatrix): array
    {
        $fieldsLightedByBulb = [];
        $roomHelper = new RoomsHelper();
        //Recorrer toda la matriz para saber si hay una casilla en 0
        foreach ($originalmatrix as $indexCol => $cols) {
            foreach ($cols as $indexRaw => $value) {

                if ($value == 0) {
                    $downFields = $roomHelper->down($indexCol, $indexRaw, $originalmatrix, false);
                    $rightFields = $roomHelper->right($indexCol, $indexRaw, $originalmatrix, false);
                    $upFields = $roomHelper->up($indexCol, $indexRaw, $originalmatrix, false);
                    $leftFields = $roomHelper->left($indexCol, $indexRaw, $originalmatrix, false, true);

                    $totalFieldsLighted = $roomHelper->getTotalFieldsLighted($downFields, $rightFields, $upFields, $leftFields);

                    $fieldsLightedByBulb[$indexCol.'-'.$indexRaw] = $totalFieldsLighted;
                } elseif ($value == 1) {
                    continue;
                } elseif ($value == 2 || $value == 3) {
                    continue;
                }
            }
        }
        arsort($fieldsLightedByBulb);

        return $fieldsLightedByBulb;
    }
}
