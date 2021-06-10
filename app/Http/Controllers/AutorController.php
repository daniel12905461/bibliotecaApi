<?php

namespace App\Http\Controllers;

use App\Models\autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $autor = autor::all();

        return response()->json($autor, 200);
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
        $autor = new autor();
        $autor->nombre = ucwords($request->input('nombre'));
        $autor->enabled = '1';
        $autor->save();

        return response()->json($autor, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $autor = autor::find($id);

        return response()->json($autor, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(autor $autor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $autor = autor::find($id);
        $autor->nombre = ucwords($request->input('nombre'));
        $autor->save();

        return response()->json($autor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $autor = autor::find($id);
        $autor->delete();

        return response()->json($autor, 200);
    }

    public function enabled($id)
    {
        //
        $autor = autor::find($id);
        if ($autor->enabled == '1') {
            $autor->enabled = '0';
        }else{
            $autor->enabled = '1';
        }
        $autor->save();

        return response()->json($autor, 200);
    }

    public function habilitados()
    {
        //
        $autores = autor::where('enabled', '1')->get();

        return response()->json($autores, 200);
    }
}
