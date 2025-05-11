<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Translation;

class SeedLargeTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:large-translations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed 100k+ translation records';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //php -d memory_limit=512M artisan seed:large-translations
        Translation::factory()->count(100000)->create();
        $this->info('Seeded 100,000+ translations successfully.');
    }
}
