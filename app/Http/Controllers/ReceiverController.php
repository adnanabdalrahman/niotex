<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ReceiverController extends Controller
{
    
    public function receivePostData(Request $request)
    {
        $data = $request->all();

        Log::info('Received JSON Data:', $data);

        return response()->json([
            'message' => 'Data received successfully',
        ], 200);
    }
}
