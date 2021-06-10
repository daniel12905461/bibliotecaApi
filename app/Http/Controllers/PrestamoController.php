<?php

namespace App\Http\Controllers;

use App\Models\prestamo;
use App\Models\prestamoLibros;
use App\Models\libro;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $prestamo = prestamo::with('libros')->orderBy('id', 'DESC')->get();

        return response()->json($prestamo, 200);
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
        $prestamo = new prestamo();
        $prestamo->nombres = $request->input('nombres');
        $prestamo->apellidos = ucfirst($request->input('apellidos'));
        $prestamo->ci = $request->input('ci');
        $prestamo->curso = $request->input('curso');
        $prestamo->grado = $request->input('grado');
        $prestamo->estado = '1';
        $prestamo->fecha = now();
        $prestamo->save();

        $id_prestamo = $prestamo->id;
        $libros = $request->input('libros');
        // dd($libros);

        foreach ($libros as $libro) {
            $prestamoLibros = new prestamoLibros();
            $prestamoLibros->libros_id = $libro['id'];
            $prestamoLibros->prestamos_id = $id_prestamo;
            $prestamoLibros->estado = '1';
            $prestamoLibros->save();
        }

        return response()->json($prestamo, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(prestamo $prestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(prestamo $prestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, prestamo $prestamo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(prestamo $prestamo)
    {
        //
    }

    public function autorizar($id)
    {
        //
        $prestamo = prestamo::with('libros')->find($id);
        $prestamo->estado = '2';
        $prestamo->save();

        foreach ($prestamo->libros as $libro) {
            $libro = libro::find($libro['id']);
            $libro->estado = '1';
            $libro->save();
        }

        return response()->json($prestamo->libros, 200);
    }

    public function prestamos()
    {
        //
        $prestamo = prestamo::with('libros')
            ->where('estado','1')
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json($prestamo, 200);
    }

    public function devoluciones()
    {
        //
        $prestamo = prestamo::with('libros')
            ->where('estado','2')
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json($prestamo, 200);
    }

    public function devolber($id)
    {
        //
        $prestamo = prestamo::with('libros')->find($id);
        $prestamo->estado = '0';
        $prestamo->save();

        foreach ($prestamo->libros as $libro) {
            $libro = libro::find($libro['id']);
            $libro->estado = '0';
            $libro->save();
        }

        return response()->json($prestamo->libros, 200);
    }
}
