<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Orchid\Attachment\Models\Attachment;

class AttachmentClear extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'attachment:clear';

    /**
     * The console command description.
     */
    protected $description = 'Remove dont relation attachment';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $unrelatedAttachments = Attachment::doesntHave('relationships')
            ->where('created_at', '<', now()->subMinutes(3))
            ->get();

        $unrelatedAttachments->each->delete();

        return Command::SUCCESS;
    }
}
