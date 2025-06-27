<?php

use App\Jobs\DeleteUnpaidOrders;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::job(new DeleteUnpaidOrders())->everyMinute();
