<?php

namespace App\Console\Commands;

use App\Http\Controllers\BlogController;
use Illuminate\Console\Command;

class CancelIdelTrip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:cancel-idel-trips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel idel trips whose not join any driver';

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
        $controller = new BlogController;
        $controller->getIdelTrips();
        logger('TEST Cancel');
    }
}
