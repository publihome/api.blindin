<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnunciosController extends Controller
{
    //

    public function index(){

    }
    public function getAddsTop(){
        $url="http://localhost:8000/storage";
        $publicidad = new Publicidad;
        return $publicidad;
        exit;
        $data =  $publicidad->getAdds("top");
        foreach($data as $anuncio){
            $anuncio->image = $url.'/'.$anuncio->image    ;
        }
        // var_dump($data);
        // $data->image = $url .'/'. $data->image;
        return $data;
    }

    public function hola(){
        print "hola mundo";
    }

}
