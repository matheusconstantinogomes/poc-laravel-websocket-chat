<?php

namespace App\Repositories\Contracts;

interface MessageRepositoryInterface
{
    public function save($content);

    public function all();
}
