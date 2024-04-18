<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ifsnop\Mysqldump as IMysqldump;

class DumpDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a snapshot of the current Database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!file_exists('.dumps')) {
            mkdir('.dumps', 0777, true);
        }
        $connectionString = sprintf("%s:host=%s;dbname=%s", env('DB_CONNECTION'), env('DB_HOST'), env('DB_DATABASE'));

        $fileName = sprintf('dump-%s.sql', time());
        $filePath = sprintf('.dumps/%s', $fileName);
        $fileHandler = fopen($filePath, 'x') or die(sprintf("Can't create dump file --- ", $fileName));
        fclose($fileHandler);

        try {
            $dump = new IMysqldump\Mysqldump($connectionString, env('DB_USERNAME'), env('DB_PASSWORD'));
            $dump->start($filePath);
        } catch (\Throwable $th) {
            throw $th;
        }

        printf('Dump created --- %s', $filePath);
    }
}
