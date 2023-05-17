<?php

namespace App\Command\scan;

class DefaultController extends \Minicli\Command\CommandController
{

    /**
     * @inheritDoc
     */
    public function handle(): void
    {
        $this->getPrinter()->display("scan command called");
    }
}