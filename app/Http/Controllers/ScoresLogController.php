<?php

namespace App\Http\Controllers;

use App\Models\ScoresLog;
use App\Http\Requests\StoreScoresLogRequest;
use App\Http\Requests\UpdateScoresLogRequest;

class ScoresLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreScoresLogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScoresLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScoresLog  $scoresLog
     * @return \Illuminate\Http\Response
     */
    public function show(ScoresLog $scoresLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScoresLog  $scoresLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ScoresLog $scoresLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScoresLogRequest  $request
     * @param  \App\Models\ScoresLog  $scoresLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScoresLogRequest $request, ScoresLog $scoresLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScoresLog  $scoresLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoresLog $scoresLog)
    {
        //
    }
}
