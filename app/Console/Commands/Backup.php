<?php

namespace App\Console\Commands;

use Mail;
use App\Mail\DbBackupMail;
use Illuminate\Console\Command;

class Backup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DB:Backup';

    /**
     * The tables for exporting.
     *
     * @var array
     */
    protected $tables = array();

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'COMMAND FOR DATABASE BACKUP';

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

        $sqlFile = $this->sqlDump();

        Mail::to('info.novasell@gmail.com')->send(new DbBackupMail($sqlFile));

    }

    protected function sqlDump(){

        if(is_dir(storage_path('app/sql-exports')))
            exec('rm -r '.storage_path('app/sql-exports'));

        \Artisan::call('backup:run');
        $file = \File::allFiles(storage_path('app/sql-exports'));
        return $file[0];
    }
}