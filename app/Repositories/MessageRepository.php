<?php

namespace App\Repositories;

use App\Models\Message;
use App\Repositories\Contracts\MessageRepositoryInterface;

class MessageRepository implements MessageRepositoryInterface
{
    public function save($content)
    {
        $message = new Message(['content' => $content]);
        $message->save();
        return $message;
    }

    public function all()
    {
        return Message::orderBy('created_at', 'asc')->get();
    }
}
