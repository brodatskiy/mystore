<?php

use App\Console\Commands\AttachmentClear;
use App\Jobs\DeleteUnpaidOrders;

Schedule::job(new DeleteUnpaidOrders())->everyMinute();

Schedule::command(AttachmentClear::class)->daily();
