<?php

namespace App;

use ScoutElastic\IndexConfigurator;
use ScoutElastic\Migratable;

class MessagesIndexConfigurator extends IndexConfigurator
{
    use Migratable;

    protected $name = "messages";

    /**
     * @var array
     */
    protected $settings = [];
}
