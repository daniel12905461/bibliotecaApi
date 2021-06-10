<?php

namespace App\Http\Controllers;

use App\Models\libro;
use App\Models\autor;
use App\Models\categoria;
use App\Models\coleccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $libros = libro::all();
        $libros = libro::with('autor')->get();

        return response()->json($libros, 200);
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
        $categoria = categoria::where('id', $request->input('categoria_id'))->with('institucion')->get();
        $codigo = $categoria[0]->institucion->codigo.'-'.$categoria[0]->codigo.'-'.$request->input('numeroLibro');

        $libro = new libro();
        $libro->autor_id = $request->input('autor_id');
        $libro->titulo = ucfirst($request->input('titulo'));
        $libro->numeroEdicion = $request->input('numeroEdicion');
        $libro->lugarEdicion = $request->input('lugarEdicion');
        $libro->anioEdicion = $request->input('anioEdicion');
        $libro->descripcion = $request->input('descripcion');
        $libro->codigo = $codigo;
        // $libro->coleccion_id = "";
        $libro->categoria_id = $request->input('categoria_id');
        $libro->enabled = '1';
        $imagen_file = $request->file('imagen');
        if ($imagen_file) {
            $ruta_imagen = Str::random(10).$imagen_file->getClientOriginalName();
            \Storage::disk('images')->put($ruta_imagen, \File::get($imagen_file));
            $libro->imagen = $ruta_imagen;
        }else {
            $libro->imagen = 'noImg';
            // return response()->json('La Imagen del Libro es requerido', 404);
        }
        $pdf_file = $request->file('archivo');
        if ($pdf_file) {
            $ruta_pdf = Str::random(10).$pdf_file->getClientOriginalName();
            \Storage::disk('pdf')->put($ruta_pdf, \File::get($pdf_file));
            $libro->archivo = $ruta_pdf;
        }
        $libro->save();

        // $id_libro = $libro->id;
        // $libro = libro::find($id_libro);
        // $libro->codigo = $codigo.'-'.$id_libro;
        // $libro->save();

        return response()->json($libro, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $libro = libro::find($id);

        return response()->json($libro, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(libro $libro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $categoria = categoria::where('id', $request->input('categoria_id'))->with('institucion')->get();
        $codigo = $categoria[0]->institucion->codigo.'-'.$categoria[0]->codigo.'-'.$request->input('numeroLibro');

        $libro = libro::find($id);
        $libro->autor_id = $request->input('autor_id');
        $libro->titulo = ucfirst($request->input('titulo'));
        $libro->numeroEdicion = $request->input('numeroEdicion');
        $libro->lugarEdicion = $request->input('lugarEdicion');
        $libro->anioEdicion = $request->input('anioEdicion');
        $libro->descripcion = $request->input('descripcion');
        $libro->codigo = $codigo;
        // $libro->coleccion_id = "";
        $libro->categoria_id = $request->input('categoria_id');
        // $libro->enabled = '1';
        $imagen_file = $request->file('imagen');
        if ($imagen_file) {
            $ruta_imagen = Str::random(10).$imagen_file->getClientOriginalName();
            \Storage::disk('images')->put($ruta_imagen, \File::get($imagen_file));
            $libro->imagen = $ruta_imagen;
        }
        $pdf_file = $request->file('archivo');
        if ($pdf_file) {
            $ruta_pdf = Str::random(10).$pdf_file->getClientOriginalName();
            \Storage::disk('pdf')->put($ruta_pdf, \File::get($pdf_file));
            $libro->archivo = $ruta_pdf;
        }
        $libro->save();

        return response()->json($libro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $libro = libro::find($id);
        $libro->delete();

        return response()->json($libro, 200);
    }

    public function enabled($id)
    {
        //
        $libro = libro::find($id);
        if ($libro->enabled == '1') {
            $libro->enabled = '0';
        }else{
            $libro->enabled = '1';
        }
        $libro->save();

        return response()->json($libro, 200);
    }

    public function habilitados()
    {
        //
        // $libro = libro::with('autor')->get();
        $libro = libro::active()->get();

        return response()->json($libro, 200);
    }

    public function find(Request $request)
    {
        //
        $libros = libro::active()
        ->OfAutor($request->input('autor_id'))
        ->OfCategoria($request->input('categoria_id'))
        ->OfTitulo($request->input('titulo'))
        ->with('autor')
        ->with('categoria')
        ->with('coleccion')
        ->get();

        return response()->json($libros, 200);
    }

    public function PDF(Request $request)
    {
        //
        // $pdf = PDF::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
        $libros = libro::with(['autor','categoria'])->get();
        $pdf = \App::make('dompdf.wrapper');
        $html = '
        <style>
        .page-break {
            page-break-after: always;
        }
        .cabesera {
            text-align: center;
        }
        .tdCenter {
            text-align: center;
        }

        td {
          font-size: 13px;
        }

        th {
          font-size: 13px;
        }
        </style>
        <html>
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            </head>
            <body>
                <div class="cabesera"><h3>IMVENTARIO DE BIBLIOTECA UEAS</h3></div>
                    <table border="1" align="center" bordercolor="blue" cellspacing="0" style="width:100%;">
                        <tr>
                            <th>ITEMS</th>
                            <th>LIBROS</th>
                            <th>EDITORIAL</th>
                            <th>AREA</th>
                        </tr>
        ';
        for ($i=0; $i < 100; $i++) {
        foreach ($libros as $key => $libro) {
            $html .= '
                            <tr>
                                <td class="tdCenter">'.($key+1).'</td>
                                <td>'.$libro->titulo.'sdfsdf sdfsdf sdf fd df df adf adfdfsdfsdfsdf</td>
                                <td class="tdCenter">'.$libro->lugarEdicion.'</td>
                                <td class="tdCenter">'.$libro->categoria->nombre.'</td>
                            </tr>
            ';
        }
        }
        $html .= '
                    </table>
            </body>
        </html>
        ';
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
}
