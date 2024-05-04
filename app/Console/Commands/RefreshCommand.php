<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{

    protected $signature = 'my-store:refresh';

    protected $description = 'Refresh';

    public function handle()
    {
        if (app()->isProduction()) {
            return self::FAILURE;
        }

        Storage::deleteDirectory('public');

        $this->call('migrate:fresh', ['--seed' => true]);
        $this->call('orchid:admin', ['name' => 'admin', 'email' => 'admin@admin.com', 'password' => 'password']);

        return self::SUCCESS;
    }
}
