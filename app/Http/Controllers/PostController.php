<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->editColumn('fullname', function ($row) {
                        return Str::limit($row->fullname, $limit = 10, $end = '...');
                    })
                    ->addColumn('action', function($row){
                        // return '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                        return '<a class="btn btn-success text-light edit-modal" data-url="'. asset("post/{$row->id}") .'" data-toggle="modal" data-target="#postModal" title="Create a project"><i class="fas fa-edit"></i></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('post.create', [
            'post' => $post, 'title' => 'Create Post', 'button' => 'Save',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        unset($data['_token']);
        Post::updateOrCreate(
            ['id' => $data['id']], $data
        );
        return response()->json(['message' => 'Post saved successfully.']);
        // return back()->with('success', 'Post saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.create', [
            'post' => $post, 'title' => 'Edit Post', 'button' => 'Update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
