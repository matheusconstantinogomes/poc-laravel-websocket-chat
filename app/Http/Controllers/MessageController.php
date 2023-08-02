<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\MessageRepositoryInterface;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }
    
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
    
        $messageModel = $this->messageRepository->save($message);
    
        return response()->json(['success' => true]);
    }
    
    public function getMessages()
    {
        $messages = $this->messageRepository->all();
        return response()->json(['messages' => $messages]);
    }
}
