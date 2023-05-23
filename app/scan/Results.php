<?php

namespace App\Scan;


class Results {
    public function __construct(public string $host,public array $portStates){}
}
