<?php

use App\scan\Scan;

function listenOnPort(string $host, $port): Socket {
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    socket_bind($socket, $host, $port);
    socket_listen($socket);

    return $socket;
}

it('scans a host', function () {
    $host = "localhost";

    // adjust this depending on the ports closed on your machine
    $ports = [
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
    // close 1
    socket_close($conns[1]);

    $results = Scan::run($hl, $ports);


    expect(count($results[0]->portStates))->toBe(3);

    expect($results[0]->portStates[0]->open)->toBe(true);
    expect($results[0]->portStates[1]->open)->toBe(false);
    expect($results[0]->portStates[2]->open)->toBe(true);

    socket_close($conns[0]);
    socket_close($conns[2]);
});