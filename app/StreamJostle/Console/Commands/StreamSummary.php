<?php

namespace StreamJostle\Console\Commands;

use App\StreamSummary;
use GuzzleHttp\Client;
use Illuminate\Console\Command;


class StreamSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitch:stream-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queries Twicth for the current number of live channels and viewers.';

    /**
     * @var \App\StreamSummary
     */
    protected $stream_summary;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StreamSummary $stream_summary)
    {
        parent::__construct();

        $this->stream_summary = $stream_summary;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'https://api.twitch.tv/kraken/',
            'headers' => ['Accept' => 'application/vnd.twitchtv.v3+json'],
            'timeout'  => 5.0
        ]);

        $res = $client->request('GET', 'streams');
        // $res = json_decode($client, true);
        file_put_contents(app_path('/StreamJostle/test.txt'), json_encode($res));
        // exit(PHP_EOL.json_encode($res).PHP_EOL);
    }
}
