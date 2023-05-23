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
    $hl->remove("host1");

    expect(count($hl->hosts))->toBe(1);
});

it('throws error when you remove a host not in the list', function () {
    $hl = new HostsList([]);

    expect(fn() => $hl->remove("host1"))->toThrow("Host not in the list");

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
