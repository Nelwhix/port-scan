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

function Run(HostsList $hl, array $ports): array {
    foreach($hl->hosts as $h) {
        $r = [
          'host' => $h
        ];
        $isValid = checkdnsrr($h);
        if (!$isValid) {
            $r[] = [
                'notFound' => true
            ];
            continue;
        }

        foreach ($ports as $port) {

        }
    }
}