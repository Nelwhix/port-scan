<?php

namespace App\Command\scan;

use App\scan\HostsList;
use App\scan\Scan;

class DefaultController extends \Minicli\Command\CommandController
{
    public function handle(): void
    {
        if (!$this->hasParam('ports')) {
            $this->getPrinter()->display("No ports given!");
            return;
        }

        $ports = explode(",", $this->getParam('ports'));
        $hl = new HostsList([]);
        $hl->load("pScan.hosts");

        $results = Scan::run($hl, $ports);

        foreach ($results as $result) {
            $this->getPrinter()->display($result->host);

            foreach ($result->portStates as $portState) {
                $status = $portState->open ? "open" : "closed";

                $this->getPrinter()->display("\t" . $portState->port . ": " . $status);
            }
        }
    }
}