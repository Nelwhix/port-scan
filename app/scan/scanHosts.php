<?php

namespace App\Scan;

class PortState {
    public function __construct(public int $port, public bool $open = false) {}
}

function scanPort(string $host, int $port): PortState {
    $p = new PortState($port);
    $conn = fsockopen($host, $port);
    if (!$conn) {
        return $p;
    }
    fclose($conn);
    $p->open = true;

    return $p;
}

class Results {
    public function __construct(public string $host,public array $portStates, public bool $notFound = true){}
}