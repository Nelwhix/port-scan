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

function Run(HostsList $hl, array $ports): array {
    $res = [];
    foreach($hl->hosts as $h) {
        $r = new Results($h, []);
        $isValid = checkdnsrr($h);
        if (!$isValid) {
            $res[] = $r;
            continue;
        }

        foreach ($ports as $p) {
            $r->portStates[] = scanPort($h, $p);
        }
        $res[] = $r;
    }

    return $res;
}