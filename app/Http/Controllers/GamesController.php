<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use App\GameSummary;
use App\Game;
use Carbon;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$now = Carbon::now();
        $offset = 0;
        $limit = 100;
        $game = new Game;
        $summary = new GameSummary;
        
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

            // dd($body);

            foreach ($body['top'] as $top)
            {
                // attempt to find game id
                $game = $game->where('twitch_id', $top['game']['_id'])->first();

                // add game to games table if doesn't exist
                if(!$game)
                {
                    $game = new Game;
                    $game->twitch_id		= $top['game']['_id'];
                    $game->giantbomb_id		= $top['game']['giantbomb_id'];
                    $game->name 			= $top['game']['name'];
                    $game->box_small		= $top['game']['box']['small'];
                    $game->box_medium		= $top['game']['box']['medium'];
                    $game->box_large		= $top['game']['box']['large'];
                    $game->logo_small		= $top['game']['logo']['small'];
                    $game->logo_medium		= $top['game']['logo']['medium'];
                    $game->logo_large		= $top['game']['logo']['large'];
                    $game->save();
                }

	            // add game summary data
	            $summaryArray[] = [
	            	'game_id' 		=> $game->id,
	            	'channels'		=> $top['channels'],
	            	'viewers'		=> $top['viewers'],
	            	'created_at'	=> $now
	            ];
            }


            // insert game summary data
            $summary->insert($summaryArray);
       		// dd($summaryArray);	

            // increment offset
            $offset = $offset + $limit;

        } while(count($body['top']) > 0);


        // insert game summaries
        // $summary->insert($summaryArray);

        echo 'Done';

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
