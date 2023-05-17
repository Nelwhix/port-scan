<?php

namespace App\Scan;

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