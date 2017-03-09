<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticiparFuncionController extends Controller
{
    public function participar($id) {
        $funcion = DB::selectOne('select * from funciones where id = ' . $id);
        $cantidad_participantes = DB::selectOne('select COUNT(*) from participantes_funcion where funcion_id = ' . $id)->count;
        if ($cantidad_participantes <= $funcion->acomodadores) {
            $user_id = Auth::user()->id;
            DB::insert('insert into participantes_funcion (funcion_id, acomodador_id) values (?, ?)', [$funcion->id, $user_id]);
             // TODO: Agregar aviso de exito
        } else {
            // No hay cupo disponible en esta funcion
            // TODO: Agregar aviso de fallo
        }
        return redirect('funciones');
    }

    public function eliminar($id, $user_id) {
        $participante_funcion = DB::selectOne('select * from participantes_funcion where funcion_id = ' . $id . ' and acomodador_id = ' . $user_id);
        if ($participante_funcion) {
            DB::delete('delete from participantes_funcion where funcion_id = ' . $id . ' and acomodador_id = ' . $user_id);
        }
        return redirect('/funciones/' . $id);
    }
}
