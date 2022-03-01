<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FindDriverForTrip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:find-drivers-for-trip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Found trip drivers';

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
        logger('TEST');
    }
}
