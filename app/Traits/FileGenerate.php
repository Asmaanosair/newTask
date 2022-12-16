<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use PDF;

trait FileGenerate
{


    /**
     * @param $data
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     */

    public function GenetartFile($data){
        $pdf = PDF::loadView('note',$data);
        $fileName = $data->name.$data->type;
        $filePath = $data->folder->name;
        Storage::disk('public')->put($filePath.'/'. $fileName, $pdf->output());
    }

    /**
     * @param $data
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function FailedResponse($message,$status){
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $status);
    }

}
