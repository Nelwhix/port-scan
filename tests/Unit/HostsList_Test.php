<?php

use App\Scan\HostsList;

it('can add a host', function () {
    $hl = new HostsList([]);
    $hl->add("host1");
    $hl->add("host2");
    $hl->add("host3");

    expect(count($hl->hosts))->toBe(3);
});

it('can remove a host', function () {
    $hl = new HostsList([]);
    $hl->add("host1");
    $hl->add("host2");
    $hl->add("host3");

    $hl->remove("host2");

    expect(count($hl->hosts))->toBe(2);
});

it('can save a host', function () {

});
