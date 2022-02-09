<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $label = new Label();
        return view('label.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:labels|max:25',
                'description' => 'max:250',
            ],
            [
                'name.unique' => __('label.errors.name_unique'),
                'name.max' => __('validation.max'),
                'description.max' => __('validation.max')
            ]
        );

        $label = new Label();
        $label->fill($request->all());
        $label->save();
        flash(__('label.messages.create'))->success();
        return redirect()
            ->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|max:25|unique:labels,name,' . $label->id,
                'description' => 'max:250',
            ],
            [
                'name.unique' => __('label.errors.name_unique'),
                'name.max' => __('validation.max'),
                'description.max' => __('validation.max'),
            ]
        );

        $label->fill($request->all());
        $label->save();
        flash(__('label.messages.update'))->success();
        return redirect()
            ->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('label.errors.delete'))->error();
            return back();
        }

        $label->delete();
        flash(__('label.messages.delete'))->success();

        return redirect()
            ->route('labels.index');
    }
}
