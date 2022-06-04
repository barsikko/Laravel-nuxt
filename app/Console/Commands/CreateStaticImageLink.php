<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateStaticImageLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'static:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create static link to storage folder';

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
        exec('ln -s $(pwd)/storage/app/images/ $(pwd)/client/static/images');
    }
}
