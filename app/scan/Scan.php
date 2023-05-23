<?php

namespace App\scan;

class Scan
{
    private static function scanPort(string $host, int $port): PortState {
        $p = new PortState($port);

        try {
            $conn = @fsockopen($host, $port);

            if (!$conn) {
                return  $p;
            }
        } catch (\Exception $e) {
            return $p;
        }
        fclose($conn);
        $p->open = true;

        return $p;
    }
    public static function run(HostsList $hl, array $ports): array {
        $res = [];


        foreach($hl->hosts as $h) {
            $r = new Results($h, []);

            foreach ($ports as $p) {
                $r->portStates[] = Scan::scanPort($h, $p);
            }
            $res[] = $r;
        }

        return $res;
    }
}