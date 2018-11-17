<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

/**
 * Class SocketController
 * @package App\Http\Controllers
 */
class SocketController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        $message = $request->get('message');
        Message::create(['message' => $message]);
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => $message
        ], 200);
    }
}