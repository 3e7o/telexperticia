<?php

namespace App\Http\Controllers;

use App\Models\GroupParameter;
use App\Models\Parameter;
use App\Models\MedicalBoard;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GroupParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gparameters = GroupParameter::get();

        return view('app.gparameters.index', compact('gparameters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $parameters = Parameter::select('id', 'name', 'description')->get();
        $parameterSelected = [];
        return view('app.gparameters.create', compact('parameterSelected', 'parameters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $array = explode(',', $request->tags);
        $group=GroupParameter::create($request->all());
        foreach($array as $value){
            $info = ['name' => $value, 'group_id' => $group->id];
            Parameter::create($info);
        }


        return redirect()->route('gparameters.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupParameter  $product
     * @return \Illuminate\Http\Response
     */
    public function show(GroupParameter $gparameter)
    {
        return view('app.gparameters.show', compact('gparameter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupParameter  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, GroupParameter $gparameter )
    {
        $parameters = Parameter::select('group_id', 'id', 'name')->get();
        $parameterSelected = [];
        return view('app.gparameters.edit', compact('gparameter','parameterSelected', 'parameters' ));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupParameter  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupParameter $gparameter)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $array = explode(',', $request->tags);
        foreach($array as $value){
            $info = ['name' => $value, 'group_id' => $gparameter->id];
            Parameter::create($info);
        }
        $gparameter->update($request->all());

        return redirect()->route('gparameters.index')
            ->with('success', 'Product updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupParameter  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupParameter $gparameter)
    {
        $gparameter->delete();

        return redirect()->route('gparameters.index')
            ->with('success', 'Product deleted successfully');
    }
}
