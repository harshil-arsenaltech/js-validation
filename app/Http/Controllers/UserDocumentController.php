<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreuserDocumentRequest;
use App\Http\Requests\UpdateuserDocumentRequest;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserDocument::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('file', function ($row) {
                    return "<img src='" . asset('storage/' . $row->file) . "' height='100' width='100' />";
                })
                ->addColumn('action', function ($row) {
                    return '<a class="btn btn-success text-light edit-modal" data-url="' . asset("document/{$row->id}") . '" data-toggle="modal" data-target="#documentModal" title="Create a project"><i class="fas fa-edit"></i></a>';
                })
                ->rawColumns(['action', 'file'])
                ->make(true);
        }
        return view('document.index');
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
     * @param  \App\Http\Requests\StoreuserDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreuserDocumentRequest $request)
    {

        $file = time() . '.' . $request->file->getClientOriginalExtension();

        // Storage::put('public/', $file);
        file_put_contents('public', $file);
        UserDocument::create([
            'user_id'   => 1,
            'file'   => $file,
        ]);
        return response()->json(['success' => 'Successfully document uploaded.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function show(UserDocument $userDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDocument $userDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDocument $userDocument)
    {
        //
    }
}
