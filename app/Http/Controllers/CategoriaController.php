<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorias = categoria::all();

        return response()->json($categorias, 200);
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
        $categoria = new categoria();
        $categoria->nombre = ucwords($request->input('nombre'));
        $categoria->enabled = '1';
        $categoria->codigo = $request->input('codigo');
        $categoria->institucion_id = '1';
        $categoria->save();

        return response()->json($categoria, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $categoria = categoria::find($id);

        return response()->json($categoria, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $categoria = categoria::find($id);
        $categoria->nombre = ucwords($request->input('nombre'));
        $categoria->save();

        return response()->json($categoria, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoria = categoria::find($id);
        $categoria->delete();

        return response()->json($categoria, 200);
    }

    public function enabled($id)
    {
        //
        $categoria = categoria::find($id);
        if ($categoria->enabled == '1') {
            $categoria->enabled = '0';
        }else{
            $categoria->enabled = '1';
        }
        $categoria->save();

        return response()->json($categoria, 200);
    }

    public function habilitados()
    {
        //
        $categoria = categoria::where('enabled', '1')->get();

        return response()->json($categoria, 200);
    }
}
