<?php

class HostsList
{
    public function __construct(public array $hosts)
    {
    }

    private function search(string $host): false|int|string {
        return array_search($host, $this->hosts);
    }

    public function add(string $host): ?\Exception {
        if ($this->search($host)) {
            return new \Exception("Host already in the list");
        }

        $this->hosts[] = $host;
        return null;
    }

    public function remove(string $host): ?\Exception {
        $i = $this->search($host);
        if ($i) {

        }
    }
 }