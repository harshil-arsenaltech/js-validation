<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class SettingController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Setting::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a class="btn btn-success text-light edit-modal" data-url="' . asset("setting/{$row->id}") . '" data-toggle="modal" data-target="#settingModal"><i class="fas fa-edit"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('setting.index');
    }

    public function store(StoreSettingRequest $request)
    {
        $fields = $request->all();
        $fields['slug'] = Str::slug($fields['name'], '_');

        Setting::updateOrCreate(
            ['id' => $request->id, 'name' => $request->name],
            $fields,
        );
        return response()->json(['message' => 'Setting saved successfully.']);
    }


    public function show(Setting $setting)
    {
        return $setting;
    }

    public function destroy(Setting $setting)
    {
        //
    }
}
