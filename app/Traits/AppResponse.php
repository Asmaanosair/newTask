<?php
namespace App\Traits;

trait AppResponse
{

    /**
     * @param $data
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     */

    public function SuccessResponse($data,$status){
        return response()->json([
            'message' => 'success',
            'status'=>true,
            'data'=>$data,
        ], $status);
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
