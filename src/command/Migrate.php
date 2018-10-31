<?php

namespace techadmin\command;

use think\migration\command\migrate\Run as MigrateRun;

class Migrate extends MigrateRun
{
    protected function configure()
    {
        parent::configure();
        $this->setName('techadmin:migrate:run')->setDescription('Migrate the database for techadmin');
    }

    protected function getPath()
    {
        return __DIR__.'/../../database/migrations';
    }
}
