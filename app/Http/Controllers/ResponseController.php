<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    // return exito
    public function sendRes($result, $message, $code = 200)
    {
        $response = [
            'ok' =>    true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json($response, $code);
    }

    // return "Error"
    public function sendError($errorMessage = "", $code = 200)
    {
        $response = [
            'ok' => false,
            'message' => $errorMessage
        ];

        return response()->json($response, $code);
    }
}
