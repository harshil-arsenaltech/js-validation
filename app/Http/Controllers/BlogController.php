<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Setting;
use App\Models\Trip;
use App\Models\TripGroup;
use App\Models\UserLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return Str::limit($row->name, $limit = 10, $end = '...');
                })
                ->addColumn('action', function ($row) {
                    // return '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    return '<a class="btn btn-success text-light edit-modal" data-url="' . asset("blog/{$row->id}") . '" data-toggle="modal" data-target="#blogModal" title="Create a project"><i class="fas fa-edit"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Blog $blog)
    {
        return view('blog.create', [
            'blog' => $blog, 'title' => 'Create Blog', 'button' => 'Save',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $data = $request->all();
        unset($data['_token']);
        Blog::updateOrCreate(
            ['id' => $data['id']],
            $data
        );
        return response()->json(['message' => 'Blog saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        return $blog;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return view('blog.create', [
            'blog' => $blog, 'title' => 'Edit Blog', 'button' => 'Update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }


    // 6371    Taking this for getting distance in KM.
    public function findNearestLocationInKM()
    {
        $lat = 23.0112;
        $lon = 72.5631;

        $distance = Setting::where('slug', 'distance')->first();

        $distance = !empty($distance) ? $distance->value : 5;

        $location = DB::table('user_locations')
            ->select(
                'user_locations.id',
                'user_locations.lat',
                'user_locations.lng',
                DB::raw(sprintf(
                    "(6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(user_locations.lat))
                    * cos(radians(user_locations.lng) - radians(" . $lon . "))
                    + sin(radians(" . $lat . "))
                    * sin(radians(user_locations.lat)))) AS distance",
                    $lat,
                    $lon
                ))
            )
            ->having('distance', '<', $distance)
            ->orderBy('distance', 'asc')
            ->get();
        // dd($location, empty($location), count($location));
        $totalDrivers = count($location);

        if ($totalDrivers == 0) {
            return ['message' => 'No drivers founed.'];
        }

        return [
            'message' => "Drivers found.",
            'data'    =>   $location,
        ];
    }


    public function findLocationWithNew()
    {
        $lat = 23.0112;
        $lon = 72.5631;
        $distance = '0';
        $distanceIn = 'km';
        return UserLocation::getNearBy($lat, $lon, $distance, $distanceIn);
    }


    public function getIdelTrips()
    {
        $message = "No found Trips";
        $interval = Setting::where('slug', 'idel_trip_cancel_time')->first();

        $interval = !empty($interval) ? $interval->value : 5;
        $currentTime = Carbon::now()->subMinutes($interval)->toDateTimeString();
        $data = Trip::select('trips.*', 'trip_groups.trip_id')
            ->leftjoin('trip_groups', 'trips.id', 'trip_groups.trip_id')
            ->where('trips.trip_status_id', 1)
            ->where('trips.start_trip_time', "<=", $currentTime)
            ->whereNull('trip_groups.trip_id')
            ->get();

        if (count($data) > 0) {
            Trip::whereIn('id', $data->pluck('id'))
                ->update([
                    'trip_status_id' => 5,
                    'cancellation_reason' => 'System auto cancel this trip due to no driver found since last 5 minuts'
                ]);

            $message = 'Trips cancelled sucessfully.';
        }
        return [
            'message' => $message,
            'data'  => [],
        ];
    }

    public function tripCompleted(Request $request) {
        Trip::where('trip_id', $request->trip_id)->update([
            'trip_status_id' => 2,
            'end_trip_time' => Carbon::now(),
        ]);
        return ['message' => 'success'];
    }

    public function getTripsForFindDrivers()
    {
        // INSERT INTO trip_groups (trip_id) VALUES (4);
        // update trip_groups set request_status = true where id = 4
        $data = Trip::select('trips.*', 'trip_groups.trip_id', DB::raw('sum( IF(trip_groups.request_status = 1, trip_groups.request_status, 0)) AS count_trip_group_member'))
            ->leftjoin('trip_groups', 'trips.id', 'trip_groups.trip_id')
            ->where('trips.trip_status_id', 1)
            ->having('count_trip_group_member', '<=', 3)
            ->groupBy('trips.id')
            ->get();

        return $data;
    }
}
