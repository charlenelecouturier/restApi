<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\models\ShortLink;


class GetUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getTrueUrl {code}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $find = ShortLink::where('code', $this->argument('code'))->first();
        echo response()->json(array('true url'=> $find->link))->getContent();
    }
}
