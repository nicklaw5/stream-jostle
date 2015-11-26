<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;
use App\StreamSummary;
use Carbon;

class StreamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $client = new Client([
        //     'base_uri' => 'https://api.twitch.tv/kraken/',
        //     'headers' => ['Accept' => 'application/vnd.twitchtv.v3+json'],
        //     'timeout'  => 5.0
        // ]);

        // $res = $client->request('GET', 'streams/summary');

        // $body = json_decode($res->getBody(), true);
        
        // $summary = new StreamSummary;
        // $summary->insert([
        //         'channels'  	=> $body['channels'],
        //         'viewers'   	=> $body['viewers'],
        //         'created_at'	=> Carbon::now()
        //     ]
        // );


        // $summary->channels  = $body['channels'];
        // $summary->viewers   = $body['viewers'];
        // $summary->save();
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
