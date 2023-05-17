<?php

use function App\Scan\Run as checkHosts;

function listenOnPort(string $host, $port): Socket {
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    socket_bind($socket, $host, $port);
    socket_listen($socket);

    return $socket;
}

it('scans a host', function () {
    $host = "localhost";
    $ports = [
        "3000",
        "5173",
        "8000",
        "8080"
    ];
    $hl = new \App\Scan\HostsList([]);
    $hl->add($host);
    $conns = [];

    foreach ($ports as $p) {
        $conns[] = listenOnPort($host, $p);
    }

    foreach($conns as $conn) {
        socket_close($conn);
    }

    checkHosts($hl, $ports);

//    $results = Run($hl, $ports);
//    expect(count($results))->toBe(4);
//    expect($results[0]->host)->toBe($host);
//    expect($results[0]->notFound)->toBe(false);
//    expect(count($results[0]->portStates))->toBe(4);
})->only();
