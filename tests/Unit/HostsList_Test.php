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

it('can save hosts and load from a host file', function () {
    $hl1 = new HostsList([]);
    $hl2 = new HostsList([]);

    $hl1->add("host1");
    $hl1->add("host2");
    $hl1->add("host5");

    $tf = tempnam(sys_get_temp_dir(), 'prefix_');
    $hl1->save($tf);
    $hl2->load($tf);

    expect($hl1->hosts)->toBe($hl2->hosts);

    unlink($tf);
});
