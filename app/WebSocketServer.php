<?php

namespace App;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $connection)
    {
        $this->clients->attach($connection);
        echo "Nova conexão: {$connection->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $message)
    {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Enviada por #%d: %s' . "\n", $from->resourceId, $message);
    
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($message);
            }
        }
    }

    public function onClose(ConnectionInterface $connection)
    {
        $this->clients->detach($connection);
        echo "Conexão {$connection->resourceId} foi desconectada\n";
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        echo "Ocorreu um erro: {$e->getMessage()}\n";
        $connection->close();
    }
}
