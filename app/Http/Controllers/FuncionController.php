<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CrearFuncionRequest;

class FuncionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  // Pag Funciones
    {
        $funciones= DB::select('select f.id, count(pf.funcion_id) as cantidad_participantes, f.acomodadores, f.fecha, f.comentario
                                from participantes_funcion pf
                                inner join funciones f on (f.id = pf.funcion_id)
                                group by f.id, pf.funcion_id, f.acomodadores, f.fecha, f.comentario
                                order by f.id desc');
        return view('funciones.index')
          ->with('funciones', $funciones);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('funciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearFuncionRequest $request) //Agregar funcion
    {
        DB::insert('insert into funciones(fecha,acomodadores,comentario,admin_id) values(?,?,?,?)',
          [$request->fecha,$request->acomodadores,$request->comentario, Auth::user()->id]);
          return redirect('funciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //Ver.. Participantes
    {
        $funcion = DB::selectOne('select * from funciones where id = ' . $id);
        $participantes = DB::select('select users.nombre, users.apellido, users.id
                                    from funciones
                                    inner join participantes_funcion on (participantes_funcion.funcion_id = funciones.id)
                                    inner join users on (participantes_funcion.acomodador_id = users.id) where funciones.id = ' . $id);
        return view('funciones.show')
                ->with('funcion', $funcion)
                ->with('participantes', $participantes)
                ->with('user', Auth::user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
