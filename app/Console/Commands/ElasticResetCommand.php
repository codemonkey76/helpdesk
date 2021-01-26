<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;

class ElasticResetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush and rebuild messages index';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
            //Try to remove old index.
            $this->call('elastic:drop-index', [
                "index-configurator" => "App\MessagesIndexConfigurator"
            ]);

        //Create to new index.
        $this->call('elastic:create-index', [
            "index-configurator" => "App\MessagesIndexConfigurator"
        ]);

        //Update mapping.
        $this->call('elastic:update-mapping', [
            "model" => "App\Models\Message"
        ]);

        //Update index.
        $this->call('elastic:update-index', [
            "index-configurator" => "App\MessagesIndexConfigurator"
        ]);

        //Add to index.
        Message::all()->searchable();

        // Import entire database, make sure to enable jobs queue first.
        $this->call('scout:import', [
            "model" => "App\Models\Message"
        ]);

        return 0;
    }
}

