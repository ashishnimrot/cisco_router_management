<?php

namespace App\Console\Commands;

use App\Models\Router;
use Illuminate\Console\Command;

class GenerateRouter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-data:router {numbers}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Router sample data generate commond';

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
         $numbers = $this->argument('numbers');

//         $this->validates($numbers);
//
//         if (!$this->confirm('Is '.$numbers.' correct, do you wish to continue? [y|N]')) {
//            $this->askValue($numbers);
//         }

         Router::factory()->count($numbers)->create();

         $this->info("Data generate successfully");
    }

    /**
     * Validate user input
     *
     * @param $numbers
     */
    private function validates(&$numbers){
        if(!is_numeric($numbers) || $numbers <= 0){
            $this->error("Please enter numberic value in beetween 1 - 1000");
            $numbers = null;
            $this->askValue($numbers);
        }
    }

    /**
     * Fetch user input
     *
     * @param $numbers
     */
    private function askValue(&$numbers){
        $numbers = $this->ask("Please enter numeric values");
        $this->validates($numbers);
    }
}
