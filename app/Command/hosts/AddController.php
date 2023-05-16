<?php

namespace App\Command\hosts;

use App\Scan\HostsList;
use Minicli\Command\CommandController;

class AddController extends CommandController
{

    public function handle(): void
    {
        $hostsFile = "pScan.hosts";

        if ($this->hasParam('hosts-file')) {
            $hostsFile = $this->getParam("hosts-file");
        }

        $args = $this->getArgs();
        array_splice($args, 0, 3);
        $this->addAction($hostsFile, $args);
    }

    private function addAction(string $hostsFile, array $args)
    {
        $hl = new HostsList([]);
        $hl->load($hostsFile);

        foreach ($args as $arg) {
            try {
                $hl->add($arg);
                $this->getPrinter()->display("Added host: " . $arg);
            } catch (\Exception $e) {
                $this->getPrinter()->display("Host already in the list");
                return;
            }
        }

        $hl->save($hostsFile);
    }
}