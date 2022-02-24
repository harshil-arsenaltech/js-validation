<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripGroupRequest;
use App\Http\Requests\UpdateTripGroupRequest;
use App\Models\TripGroup;

class TripGroupController extends Controller
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
     * @param  \App\Http\Requests\StoreTripGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTripGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TripGroup  $tripGroup
     * @return \Illuminate\Http\Response
     */
    public function show(TripGroup $tripGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TripGroup  $tripGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(TripGroup $tripGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTripGroupRequest  $request
     * @param  \App\Models\TripGroup  $tripGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTripGroupRequest $request, TripGroup $tripGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TripGroup  $tripGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripGroup $tripGroup)
    {
        //
    }
}
