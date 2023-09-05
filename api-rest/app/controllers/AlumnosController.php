<?php



namespace App\Controllers;

use App\Models\Alumnos;
use Exception;

date_default_timezone_set('America/Lima');

class AlumnosController extends Controller{

    public function index(){
        
        $alumnos = Alumnos::All();
        if($alumnos){
        response()->json(["200"=>"encontrado","data"=>$alumnos]);
        }else{
            response()->json(["200"=>"no encontrado"]);
        }

    }

    public function consultar($id){

        $alumnos = Alumnos::find($id);
        if($alumnos){
        response()->json(["200"=>"encontrado","data"=>$alumnos]);
        }else{
            response()->json(["200"=>"no encontrado"]);
        }

    }

    public function agregar(){

        try{
        $alumno = new Alumnos();
        $arreglo = request()->get(['nombres', 'apellidos']);
     $alumno->nombres = $arreglo["nombres"];
        $alumno->apellidos = $arreglo["apellidos"];
        if($alumno->save()){
            $alumno = Alumnos::find($alumno->id);
            response()->json(["200"=>"Alumno insertado","Alumno creado"=>$alumno]);
        }else{
            response()->json(["200"=>"Alumno no insertado"]);
        }
        }catch(Exception $e){
            response()->json(["200"=>"Alumno no insertado por problemas"]);
        }
    }

    public function borrar($id){

        try{
        
          if(Alumnos::destroy($id)){
            response()->json(["200"=>"eliminado","Alumno con el id"=>$id]);
          }else{
            response()->json(["200"=>"No eliminado","No se pudo eliminar al Alumno con el id"=>$id]);
          }

        }catch(Exception $e){
            response()->json(["200"=>"El alumno no pudo ser eliminado"]);
        }
    }

    public function actualizar($id){

        try{
        $arreglo = request()->get(['nombres', 'apellidos']);
        $nombres = $arreglo["nombres"];
        $apellidos = $arreglo["apellidos"];

        $alumno = Alumnos::findOrFail($id);

            $alumno->nombres = $nombres ?? $alumno->nombres;
            $alumno->apellidos = $apellidos ?? $alumno->apellidos;
            if( $alumno->update()){
                response()->json(["200"=>"Alumno actializado correctamente","Alumno"=>$alumno ]);
            }else{
                 response()->json(["200"=>"No se pudo actualizar el alumno"]);
            }
           
        }catch(Exception $e){
            response()->json(["200"=>"Alumno no actualizado por problemas"]);
        }
    }

}