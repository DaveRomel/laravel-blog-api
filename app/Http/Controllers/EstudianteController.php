<?php
namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index()
    {
       return Estudiante::all();
       //return "Hola mundo";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'foto' => 'required'
        ]);

        $inputs = $request->input();
        $respuesta = Estudiante::create($inputs);
        //return $inputs;
        return $respuesta;
        //return $request->all();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            return response()->json([
                'data'=>$e,
                'mensaje'=>"Estudiente encontrado con exito",
            ]);
        }
        else
        {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el estudiente.",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;
            if ($e->save()){
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Estudiente actualizado con éxito",
                ]);
            }
            else
            {
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No se actualizó el estudiente.",
                ]);
            }
        }
        else{
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el estudiente.",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            $res=Estudiante::destroy($id);
            if($res){
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Estudiente eliminado con exito",
                ]);
            }
            else{
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No existe el estudiente.",
                ]);
            }
        }
        else
        {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No se encontro el estudiente.",
            ]);
        }
    }
}
