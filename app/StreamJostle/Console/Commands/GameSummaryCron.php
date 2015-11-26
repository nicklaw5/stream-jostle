<?php

namespace StreamJostle\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use App\GameSummary;
use App\Game;
use Carbon;

class GameSummaryCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitch:game-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queries Twicth for the current top games list.';

    /**
     * @var \App\Game
     */
    protected $game;

    /**
     * @var \App\GameSummary
     */
    protected $game_summary;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Game $game, GameSummary $game_summary)
    {
        parent::__construct();

        $this->game = $game;
        $this->game_summary = $game_summary;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = Carbon::now();
        $offset = 0;
        $limit = 100;
        // $game = new Game;
        // $summary = new GameSummary;
        
        $client = new Client([
            'base_uri' => 'https://api.twitch.tv/kraken/',
            'headers' => ['Accept' => 'application/vnd.twitchtv.v3+json'],
            'timeout'  => 5.0
        ]);

        do {
            $summaryArray = [];

            $res = $client->request('GET', 'games/top', [
                    'query' => [
                        'offset' => $offset, 
                        'limit' => $limit
                    ]
                ]
            );

            $body = json_decode($res->getBody(), true);

            foreach ($body['top'] as $top)
            {
                // attempt to find game id
                $game = $this->game->where('twitch_id', $top['game']['_id'])->first();

                // add game to games table if doesn't exist
                if(!$game)
                {
                    $game                   = new $this->game;
                    $game->twitch_id        = $top['game']['_id'];
                    $game->giantbomb_id     = $top['game']['giantbomb_id'];
                    $game->name             = $top['game']['name'];
                    $game->box_small        = $top['game']['box']['small'];
                    $game->box_medium       = $top['game']['box']['medium'];
                    $game->box_large        = $top['game']['box']['large'];
                    $game->logo_small       = $top['game']['logo']['small'];
                    $game->logo_medium      = $top['game']['logo']['medium'];
                    $game->logo_large       = $top['game']['logo']['large'];
                    $game->save();
                }

                // add game summary data
                $summaryArray[] = [
                    'game_id'       => $game->id,
                    'channels'      => $top['channels'],
                    'viewers'       => $top['viewers'],
                    'created_at'    => $now
                ];
            }


            // insert game summary data
            $this->game_summary->insert($summaryArray);
            // dd($summaryArray);   

            // increment offset
            $offset = $offset + $limit;

        } while(count($body['top']) > 0);


        // insert game summaries
        // $summary->insert($summaryArray);

        // echo 'Done';
    }
}
