<?php

namespace App\Scan;

class HostsList
{
    public function __construct(public array $hosts)
    {
    }

    private function search(string $host): false|int|string {
        return array_search($host, $this->hosts);
    }

    public function add(string $host) {
        if ($this->search($host)) {
            throw new \Exception("Host already in the list");
        }

        $this->hosts[] = $host;
    }

    public function remove(string $host): ?\Exception {
        $i = $this->search($host);
        if ($i) {
            array_splice($this->hosts, $i, 1);
            return null;
        }
        return new \Exception("Host not in the list");
    }

    public function load(string $hostsFile): void
    {
        $file = fopen($hostsFile, "r");

        while (($line = fgets($file)) !== false) {
            $this->hosts[] = $line;
        }

        fclose($file);
    }

    public function save(string $hostsFile): void
    {
        $file = fopen($hostsFile, "w");

        foreach($this->hosts as $host) {
            fwrite($file, $host);
        }

        fclose($file);
    }
 }