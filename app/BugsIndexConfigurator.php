<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class BugsIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = "bugs";

    /**
     * @var array
     */
    protected $settings = [];
}
