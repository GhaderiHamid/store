<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/payment', [PaymentController::class, 'handle']);
Route::post('/payment/webhook', function (Request $request) {
    $data = $request->json()->all();

    if ($data['status'] == 'success') {
        $user_id = $data['user_id'];
        $amount = $data['amount'];

        // ارسال نتیجه پرداخت به ربات تلگرام
        $bot_url = "http://127.0.0.1:5000/telegram-webhook";
        Http::post($bot_url, [
            'chat_id' => $user_id,
            'message' => "✅ پرداخت موفق! مبلغ: {$amount} تومان"
        ]);

        return response()->json(['status' => 'received']);
    }

    return response()->json(['status' => 'failed'], 400);
});
