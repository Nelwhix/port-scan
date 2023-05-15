<?php

namespace App\Command\hosts;

use App\Scan\HostsList;

class ListController extends \Minicli\Command\CommandController
{
    public function handle(): void
    {
        $hostsFile = "pScan.hosts";

       if ($this->hasParam('hosts-file')) {
           $hostsFile = $this->getParam("hosts-file");
       }

       $this->listAction($hostsFile, $this->getArgs());
    }

    private function listAction(string $hostsFile, array $args) {
        $hl = new HostsList([]);
        $hl->load($hostsFile);

        foreach ($hl->hosts as $host) {
            $this->getPrinter()->display($host);
        }
    }
}