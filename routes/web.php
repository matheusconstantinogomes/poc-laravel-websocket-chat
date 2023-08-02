<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use App\WebSocket;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/ws', function () {
    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new WebSocket()
            )
        ),
        8080
    );
    $server->run();
});

Route::post('/send-message', [MessageController::class, 'sendMessage']);

Route::get('/get-messages', [MessageController::class, 'getMessages']);
