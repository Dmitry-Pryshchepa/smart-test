<?php

namespace App\Console\Commands;

use App\Console\Models\Path;
use Illuminate\Console\Command;
use App\Console\Models\VisitorLogReader;
use App\Console\Models\PathCollection;

class ViewsLogParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:parse {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses logs file passed as agrument and shows the pages ordering by most viewed and most unique views';

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
        $path = $this->argument('path');
        $logReader = new VisitorLogReader;
        $data = $logReader->parseData($path);
        $this->outputResult($data);
    }

    /**
     * @param PathCollection $data
     * @return void
     */
    private function outputResult(PathCollection $data) :void
    {
        $this->outputOrderedVisits($data);
        $this->outputOrderedUnique($data);
    }

    /**
     * @param PathCollection $data
     * @return void
     */
    private function outputOrderedVisits(PathCollection $data) :void {
        $pageViewsMessageFormat = '%s %d visits';
        $this->info('Webpages with most page views ordered from most pages views to less page views:');
        $pathArray = $data->getSortedPathsByViews();
        /** @var Path $path */
        foreach ($pathArray as $path) {
            $this->info(
                sprintf(
                    $pageViewsMessageFormat,
                    $path->getPath(),
                    $path->getViews()
                )
            );
        }
    }

    /**
     * @param PathCollection $data
     * @return void
     */
    private function outputOrderedUnique(PathCollection $data) :void {
        $uniquePageViewsMessageFormat = '%s %d unique views';
        $this->info('List of webpages with most unique page views also ordered:');
        $pathArray = $data->getSortedPathsByUniqueViews();
        /** @var Path $path */
        foreach ($pathArray as $path) {
            $this->info(
                sprintf(
                    $uniquePageViewsMessageFormat,
                    $path->getPath(),
                    $path->getUniqueViews()
                )
            );
        }
    }
}
