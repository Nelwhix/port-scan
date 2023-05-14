<?php

namespace App\Command\hosts;

use Minicli\Command\CommandController;

class DefaultController extends CommandController
{
    public function handle(): void
    {
        $this->getPrinter()->display(<<<EOT
Manages the hosts lists for port-scan

Add hosts with the add command
Delete hosts with the delete command
List hosts with the list command.,
EOT);
    }
}