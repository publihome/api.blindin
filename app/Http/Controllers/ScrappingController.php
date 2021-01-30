<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Goutte\Client;
use App\Http\Models\noticiasModel;
use Illuminate\Support\Facades\DB;


class ScrappingController extends Controller
{
    //

    public function __constructor(){
        // $this->Models("noticiasModel");

    }

    public function index(Client $client) {
        $crawler = $client->request('GET', 'https://www.nvinoticias.com/oaxaca');
        $data = $crawler->filter('.note-destacadas')->each(function($node) {
            $titulo = $node->filter("div > div > h2 > a")->text();
            $ancla = $node->filter("div > div > h2 > a");              
            // $resumen = $node->filter("div > div > h2");             
            // print $titulo."<br>";

            
            // var_dump($titulo);
        });

        
        $array = array(
            "titulo" => "nose",
            "resumen" => "nose",
            "autor" => "nose",
            "fecha" => date("Y:m:d"),
            "categoria" => "nose",
            "url" => "nose",
            "img" => "nose jajajajajaj",
        );
        $data = DB::table('noticias')->get();
        return $data;



        // $this->noticiasModel->saveNew($array);

    }

    public function imparcial(Client $client) {
        $crawler = $client->request('GET', 'https://imparcialoaxaca.mx/ultima-hora/');
        $data = $crawler->filter(".post-content")->each(function($node) {
            $noticias = [];
            $titleNew = $node->filter(".post-content > h2" )->text();
            $author = $node->filter(".post-content > ul > li")->text(1);
            $resumen = $node->filter(".post-content")->text();
            $enlace = $node->filter(".post-content > a")->attr("href");
            // $imagen = $node->filter(".post-content > img")->attr("src");
            //$image = $node->selectImage("lazy")->image();
            //var_dump($image);


            $noticias["titulo"] = $titleNew;
            $noticias["resumen"] = $resumen;
            $noticias["autor"] = $author;
            $noticias["fecha"] = date("Y:m:d");
            $noticias["categoria"] = "Reciente";
            $noticias["url"] = $enlace;
            $noticias["img"] = "";

        DB::table('noticias')->insert($noticias);
        });
 

    }
}
