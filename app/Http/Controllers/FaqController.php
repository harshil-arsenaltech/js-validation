<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('answer', function ($row) {
                    return Str::limit($row->answer, 50, ' ...');
                })
                ->editColumn('question', function ($row) {
                    return Str::limit($row->question, 50, ' ...');
                })
                ->addColumn('action', function ($row) {
                    $action = '<a class="btn btn-primary text-light edit-modal" data-url="' . asset("faq/{$row->id}") . '" data-toggle="modal" data-target="#faqModal" title="Create a project"><i class="fas fa-edit"></i></a> ';
                    $action .= '<a class="btn btn-danger text-light delete-modal" data-url="' . asset("faq/{$row->id}") . '" data-toggle="modal" data-target="#faqDeleteModal"><i class="fas fa-delete"></i></a>';
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Faq $faq)
    {
        return view('faq.create', [
            'faq' => $faq,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqRequest $request)
    {
        $data = $request->all();
        unset($data['_token']);
        Faq::updateOrCreate(
            ['id' => $data['id']],
            $data
        );
        return response()->json(['message' => 'Faq saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return $faq;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('faq.create', [
            'faq' => $faq,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreFaqRequest  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFaqRequest $request, Faq $faq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return ['message' => 'Faq delete successfully.'];
    }
}
