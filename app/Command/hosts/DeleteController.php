<?php

namespace App\Command\hosts;

use App\Scan\HostsList;

class DeleteController extends \Minicli\Command\CommandController
{
    public function handle(): void
    {
        $hostsFile = "pScan.hosts";

        if ($this->hasParam('hosts-file')) {
            $hostsFile = $this->getParam("hosts-file");
        }

        $this->deleteAction($hostsFile, $this->getArgs());
    }

    private function deleteAction(string $hostsFile, array $args)
    {
        $hl = new HostsList([]);
        $hl->load($hostsFile);

        foreach ($args as $h) {
            try {
                $hl->remove($h);
            } catch (\Exception) {
                $this->getPrinter()->display("Host does not exist");
                return;
            }

            $this->getPrinter()->display("Deleted host: " . $h);
        }

        $hl->save($hostsFile);
    }
}