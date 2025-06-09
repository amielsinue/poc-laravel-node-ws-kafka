<?php

use Illuminate\Support\Facades\Route;
use App\Services\KafkaProducerService;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/send', function (\Illuminate\Http\Request $request, App\Services\KafkaProducerService $producer) {
    $data = $request->json()->all();

    $producer->produce([
        'message' => $data['message'] ?? 'Mensaje vacío',
        'sent_at' => \Carbon\Carbon::now()->toDateTimeString(),
    ]);

    return response()->json(['status' => 'Mensaje enviado']);
});