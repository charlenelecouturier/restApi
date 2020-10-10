<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;


class Shorturl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:short_url {link}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Url shorten';

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
        $request = Request::create('newUrl', 'POST',['link'=>$this->argument('link')]);
        $res=app()->make(\Illuminate\Contracts\Http\Kernel::class)->handle($request);
        $this->info($res->getContent());
    }

    
}
