<?php

namespace App\Http\Controllers;

use App\Models\Status;
use \Illuminate\Http\Request;

class StatusController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Status::class, 'status');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        return view('status.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('auth');
        $status = new Status();
        return view('status.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('auth');
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        $status = new Status();
        $status->fill($data);
        $status->save();
        flash(__('status.messages.create'))->success();
        return redirect()
            ->route('statuses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        $this->authorize('auth');
        return view('status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $this->authorize('auth');
        $data = $this->validate($request, [
            'name' => 'required',
        ]);

        $status->fill($data);
        $status->save();
        flash(__('status.messages.update'))->success();
        return redirect()
            ->route('statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $this->authorize('auth');
        if ($status) {
            $status->delete();
        }
        flash(__('status.messages.delete'))->success();
        return redirect()
            ->route('statuses.index');
    }
}
