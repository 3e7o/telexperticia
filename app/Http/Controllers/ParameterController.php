<?php
namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', Parameter::class);
        $parameters = Parameter::get();

        return view('app.parameters.index', compact('parameters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.parameters.create');
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
            'description' => 'required',
        ]);

        Parameter::create($request->all());

        return redirect()->route('parameters.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parameter  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Parameter $parameter)
    {
        return view('app.parameters.show', compact('parameter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parameter  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Parameter $parameter)
    {
        return view('app.parameters.edit', compact('parameter'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parameter  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parameter $parameter)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $parameter->update($request->all());

        return redirect()->route('parameters.index')
            ->with('success', 'Parámetro Actualizado');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parameter  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parameter $parameter)
    {
        $parameter->delete();

        return redirect()->route('parameters.index')
            ->with('success', 'Product deleted successfully');
    }
    public function activity_log($log_details, $fn){
        $ac = new ActiveController();
        $ac->saveLogData(auth()->user()->id, $log_details, 'ParameterController', $fn);
    }
}
