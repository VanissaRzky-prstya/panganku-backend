<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request){
        $payload=$request->all();
        $externalId=$payload['external_id'] ?? null;
        $status = $payload['status'] ?? null;

        if (!$externalId){
            return response()->json(['message' => 'No external ID'], 400);
        }
        $orderId = explode('-', $externalId)[1] ?? null;
        $order = Order::find($orderId);
        if (!$order){
            return response()->json(['message' => 'Order not found'], 404);
        }
        if ($status === 'PAID'){
            $order->update(['status' => 'paid']);
        } elseif ($status === 'EXPIRED'){
            $order->update(['status' => 'expired']);
        }
        return response()->json(['message' => 'Webhook received']);
    }
}
