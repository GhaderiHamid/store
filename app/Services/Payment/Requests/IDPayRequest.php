<?php

namespace App\Services\Payment\Requests;

use League\Flysystem\ReadInterface;
use App\Services\Payment\Contracts\RequestInterface;


class IDPayRequest implements ReadInterface
{
    private $user;
    private $price;

    public function has($path)
    {
        // Implement logic or return a default value
        return false;
    }

    public function read($path)
    {
        // Implement logic or return a default value
        return false;
    }

    public function readStream($path)
    {
        // Implement logic or return a default value
        return false;
    }

    public function listContents($directory = '', $recursive = false)
    {
        // Implement logic or return a default value
        return [];
    }

    public function getMetadata($path)
    {
        // Implement logic or return a default value
        return [];
    }

    public function getSize($path)
    {
        // Implement logic or return a default value
        return null;
    }

    public function getMimetype($path)
    {
        // Implement logic or return a default value
        return null;
    }

    public function getTimestamp($path)
    {
        // Implement logic or return a default value
        return null;
    }

    public function getVisibility($path)
    {
        // Implement logic or return a default value
        return null;
    }
    public function __construct(array $data)
    {
        $this->user = $data['user'];
        $this->price = $data['price'];
    }

    public function getUser()
    {
        return $this->user;
    }
    public function getPrice()
    {
        return $this->price;
    }
}
