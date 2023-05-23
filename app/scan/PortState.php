<?php

namespace App\scan;

class PortState
{
    public function __construct(public int $port, public bool $open = false)
    {
    }
}