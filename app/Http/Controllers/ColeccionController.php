<?php

namespace App\Http\Controllers;

use App\Models\coleccion;
use Illuminate\Http\Request;

class ColeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coleccions = coleccion::all();

        return response()->json($coleccions, 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $coleccion = new coleccion();
        $coleccion->nombre = $request->input('nombre');
        $coleccion->enabled = '1';
        $coleccion->save();

        return response()->json($coleccion, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\coleccion  $coleccion
     * @return \Illuminate\Http\Response
     */
    public function show(coleccion $coleccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\coleccion  $coleccion
     * @return \Illuminate\Http\Response
     */
    public function edit(coleccion $coleccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\coleccion  $coleccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, coleccion $coleccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\coleccion  $coleccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $coleccion = coleccion::find($id);
        $coleccion->delete();

        return response()->json($coleccion, 200);
    }

    public function enabled($id)
    {
        //
        $coleccion = coleccion::find($id);
        if ($coleccion->enabled == '1') {
            $coleccion->enabled = '0';
        }else{
            $coleccion->enabled = '1';
        }
        $coleccion->save();

        return response()->json($coleccion, 200);
    }

    public function habilitados()
    {
        //
        $coleccion = coleccion::where('enabled', '1')->get();

        return response()->json($coleccion, 200);
    }
}
