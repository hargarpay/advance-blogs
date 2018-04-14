<?php

namespace App\Console\Commands;


use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class FixCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:pusher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change use Pusher to use Pusher/Pusher';

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
     * @return mixed
     */
    public function handle()
    {
        $broadcastManagerPath = base_path('vendor/laravel/framework/src/Illuminate/Broadcasting/BroadcastManager.php');
        $pusherBroadcasterPath = base_path('vendor/laravel/framework/src/Illuminate/Broadcasting/Broadcasters/PusherBroadcaster.php');

        $contents = str_replace('use Pusher;', 'use Pusher\Pusher;', File::get($broadcastManagerPath));
        File::put($broadcastManagerPath, $contents);

        $contents = str_replace('use Pusher;', 'use Pusher\Pusher;', File::get($pusherBroadcasterPath));
        File::put($pusherBroadcasterPath, $contents);
    }
}
