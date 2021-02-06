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
        $this->Models("noticiasModel");

    }

    public function index(Client $client) {

         $imparcial = $this->imparcial($client);
        //  $tiempo = $this->tiempo($client);
        //  $rotativo = $this->rotativo($client);
        // return json_encode(array_merge($imparcial,$rotativo,$tiempo));

        // return $imparcial;

        // $this->noticiasModel->saveNew($array);
        $data = DB::table('noticias')->paginate(5);
        return json_encode($data);

    }

    public function imparcial(Client $client) {
        $crawler = $client->request('GET', 'https://imparcialoaxaca.mx/ultima-hora/');

        $data = $crawler->filter(".article-post")->each(function($node) {
            $noticias = array();
            $titleNew = $node->filter(".post-content > h2" )->text();
            $author = $node->filter(".post-content > ul > li")->eq(0)->text();
            $date = $node->filter(".post-content > ul > li")->eq(1)->text();
            $resumen = $node->filter(".post-content")->text();
            $enlace = $node->filter(".post-content > a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $textoinfo = explode($date,$resumen);

            $noticias["titulo"] = $titleNew;
            $noticias["fecha"] = date("Y:m:d");
            $noticias["resumen"] = trim($textoinfo[1]);
            $noticias["autor"] = $author;
            $noticias["categoria"] = "Reciente";
            $noticias["url"] = $enlace;
            $noticias["img"] = $image;   
            
            return $noticias;

            // 
            
            
        });

        foreach ($data as $not) {
             # code...
            if (DB::table('noticias')->where('resumen',$not["resumen"] )->doesntExist()) {
                $data = DB::table('noticias')->insert($not);
            }
        }

     }

     public function rotativo(Client $client) {
        $crawler = $client->request('GET', 'http://www.rotativooaxaca.com.mx/');
        $crawler->filter('.category-mas-informacion')->each(function($node) {
            $noticias = array();

            $title = $node->filter(".post-title > a")->text();
            $resumen = $node->filter(".entry > p")->text();
            $enlace = $node->filter(".entry > a")->attr("href");
            $image = $node->filter("img")->attr("src");



            $noticias["titulo"] = $title;
            $noticias["resumen"] = $resumen;
            $noticias["categoria"] = "Reciente";
            $noticias["autor"] = "";
            $noticias["fecha"] = date("Y:m:d");

            $noticias["url"] = $enlace;
            $noticias["img"] = $image;

            // return $noticias;
            $data = DB::table('noticias')->insert($noticias);


            // var_dump($noticias);
        });

    }


    public function tiempo(Client $client) {
        $crawler = $client->request('GET', 'https://tiempodigital.mx/category/secciones/oaxaca/');
        $crawler->filter('.td_module_1')->each(function($node) {
            $noticias = array();

            $title = $node->filter(".entry-title")->text();
            // $resumen = $node->filter(".entry > p")->text();
            $enlace = $node->filter(".entry-title > a")->attr("href");
            $image = $node->filter("img")->attr("src");

            $noticias["titulo"] = $title;
            // $noticias["resumen"] = $resumen;
            $noticias["url"] = $enlace;
            $noticias["img"] = $image;
            $noticias["categoria"] = "Reciente";

            // return $noticias;
            var_dump($noticias);
        });

    }


}
