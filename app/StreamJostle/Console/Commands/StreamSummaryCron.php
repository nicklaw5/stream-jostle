<?php

namespace StreamJostle\Console\Commands;

use Illuminate\Console\Command;

use Carbon;
use GuzzleHttp\Client;
use App\StreamSummary;

class StreamSummaryCron extends Command
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

        $res = $client->request('GET', 'streams/summary');

        $body = json_decode($res->getBody(), true);
        
        $summary = new StreamSummary;
        $summary->insert([
                'channels'      => $body['channels'],
                'viewers'       => $body['viewers'],
                'created_at'    => Carbon::now()
            ]
        );
    }
}
