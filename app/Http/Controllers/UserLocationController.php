<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserLocationRequest;
use App\Http\Requests\UpdateUserLocationRequest;
use App\Models\UserLocation;

class UserLocationController extends Controller
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
     * @param  \App\Http\Requests\StoreUserLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function show(UserLocation $userLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLocation $userLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserLocationRequest  $request
     * @param  \App\Models\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserLocationRequest $request, UserLocation $userLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLocation $userLocation)
    {
        //
    }
}
