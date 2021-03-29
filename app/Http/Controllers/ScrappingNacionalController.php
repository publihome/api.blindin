<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\NoticiasModel;

class ScrappingNacionalController extends Controller
{

    public function index(Client $client){
    $this->periodicoDeMexicoRecientes($client);
    $this->jornadaDeportes($client);
    $this->PeriodicoDeMexicoEconomia($client);
    $this->noticiasSalud($client);
    $this->altoNivelRecientes($client);
    $this->altoNivelEconomia($client);
    $this->infoSalus($client);
    $this->exelsiorRecientes($client);
    $this->exelsiorDeportes($client);
    $this->elSolDeMexicoSalud($client);
    $this->elLaJornadaEconomia($client);
    $this->elSolDeMexicoDeportes($client);

    }


    //noticias primarias

    public function periodicoDeMexicoRecientes(Client $client){
        $crawler = $client->request('GET', 'https://elperiodicodemexico.com/ultimas_noticias.php');
        $data = $crawler->filter(".article-big")->each(function($node){
            $recientes = array();
            $url="https://elperiodicodemexico.com/";

            $title = $node->filter("h2 > a")->text();
            $enlace = $url ."". $node->filter(".article-photo > a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $resumen = $node->filter(".article-content > p")->text();
            $recientes["diario"] = "periodico de mexico";
            $recientes["titulo"] = $title;
            $recientes["fecha"] = date("Y:m:d");
            $recientes["hora"] = date("G:i:s");
            $recientes["resumen"] = $resumen;
            $recientes["categoria"] = "Reciente";
            $recientes["tipo"] = "primarias";
            $recientes["url"] = $enlace;
            $recientes["img"] = $image;
            $recientes["region"] = "nacional";
            return $recientes;
        });
        $this->insertData($data);
    }


    public function jornadaDeportes(Client $client){
        $crawler = $client->request('GET', 'https://www.jornada.com.mx/category/deportes.html');
        $data = $crawler->filter(".card-deportes")->each(function($node){
            $sports = array();
            $url = "https://www.jornada.com.mx";
            $title = $node->filter("h2 > a")->text();
            $enlace = $url . "" .$node->filter("h2 > a")->attr("href");
            $image_name = $node->filter("img")->attr("src");
            $image = strpos($image_name, '/theme') === false ? $image_name : $url ."". $image_name;
            $resumen = $node->filter(".card-text > p")->text("sin resumen");
            $sports["diario"] = "la jornada";
            $sports["titulo"] = $title;
            $sports["fecha"] = date("Y:m:d");
            $sports["hora"] = date("G:i:s");
            $sports["resumen"] = $resumen;
            $sports["categoria"] = "Deportes";
            $sports["url"] = $enlace;
            $sports["img"] = $image;
            $sports["tipo"] = "primarias";

            $sports["region"] = "nacional";
            return $sports;
        });
        $this->insertData($data);
    }


    public function PeriodicoDeMexicoEconomia(Client $client){
        $crawler = $client->request('GET', 'https://elperiodicodemexico.com/seccion.php?sec=Nacional-Economia');
        $data = $crawler->filter(".article-big")->each(function($node){
            $economy = array();
            $url = "https://elperiodicodemexico.com";
            $title = $node->filter("h2 > a")->text();
            $enlace = $url ."". $node->filter(".article-photo > a")->attr("href");
            $image = $url ."". $node->filter("img")->attr("src");
            $resumen = $node->filter(".article-content > p")->text();
            $economy["diario"] = "periodico de mexico";
            $economy["titulo"] = $title;
            $economy["fecha"] = date("Y:m:d");
            $economy["hora"] = date("G:i:s");
            $economy["resumen"] = $resumen;
            $economy["categoria"] = "Economia";
            $economy["url"] = $enlace;
            $economy["img"] = $image;
            $economy["region"] = "nacional";
            $economy["tipo"] = "primarias";
// var_dump($economy);
            return $economy;
        });
        $this->insertData($data);
    }



    public function noticiasSalud(Client $client){
        $crawler = $client->request('GET', 'https://www.noticiasensalud.com/');
        $data = $crawler->filter(".infinite-post")->each(function($node){
            $health = array();
            $title = $node->filter("h2")->text();
            $enlace = $node->filter(" a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $resumen = $node->filter("p")->text();
            $health["diario"] = "noticias salud";
            $health["titulo"] = $title;
            $health["fecha"] = date("Y:m:d");
            $health["hora"] = date("G:i:s");
            $health["resumen"] = $resumen;
            $health["categoria"] = "Salud";
            $health["url"] = $enlace;
            $health["img"] = $image;
             $health["region"] = "nacional";
            $health["tipo"] = "primarias";
             return $health;
         });
        $this->insertData($data);
     }



    //noticias terciarias

    public function altoNivelRecientes(Client $client){
        $crawler = $client->request('GET', 'https://www.altonivel.com.mx/actualidad/');
        $data = $crawler->filter(".especial")->each(function($node){
            $recientes = array();
            $title = $node->filter("figcaption > strong")->text();
            $enlace = $node->filter(".especial")->attr("href");
            $image = $node->filter("img")->attr("data-src");
            $recientes["diario"] = "alto nivel";
            $recientes["titulo"] = $title;
            $recientes["fecha"] = date("Y:m:d");
            $recientes["hora"] = date("G:i:s");
            $recientes["resumen"] = "";
            $recientes["categoria"] = "Reciente";
            $recientes["url"] = $enlace;
            $recientes["img"] = $image;
            $recientes["region"] = "nacional";
            $recientes["tipo"] = "terciarias";
            return $recientes;
        });
        $this->insertData($data);
    }


    public function altoNivelEconomia(Client $client){
        $crawler = $client->request('GET', 'https://www.altonivel.com.mx/economia/');
        $data = $crawler->filter(".especial")->each(function($node){
            $economy = array();
            $title = $node->filter("figcaption > strong")->text();
            $enlace = $node->filter(".especial")->attr("href");
            $image = $node->filter("img")->attr("data-src");
            $economy["diario"] = "alto nivel";
            $economy["titulo"] = $title;
            $economy["fecha"] = date("Y:m:d");
            $economy["hora"] = date("G:i:s");
            $economy["resumen"] = "";
            $economy["categoria"] = "Economia";
            $economy["url"] = $enlace;
            $economy["img"] = $image;
            $economy["region"] = "nacional";
            $economy["tipo"] = "terciarias";
            return $economy;
        });

        $this->insertData($data);
    }


    public function infoSalus(Client $client){
        $crawler = $client->request('GET', 'https://www.infosalus.com/salud-investigacion/');
        $data = $crawler->filter(".home-articulo-portada")->each(function($node){
            $health = array();
            $title = $node->filter(".home-articulo-titulo > a")->attr("title");
            $enlace = $node->filter(".home-articulo-titulo > a")->attr("href");
            $image = $node->filter("img")->attr("data-src");
            $health["diario"] = "info salus";
            $health["titulo"] = $title;
            $health["fecha"] = date("Y:m:d");
            $health["hora"] = date("G:i:s");
            $health["resumen"] = "";
            $health["categoria"] = "Salud";
            $health["url"] = $enlace;
            $health["img"] = $image;
            $health["region"] = "nacional";
            $health["tipo"] = "terciarias";

            return $health;
        });

        $this->insertData($data);
    }



    // las imagenes estan codificadas
    public function elSolDeMexicoDeportes(Client $client){
        $crawler = $client->request('GET', 'https://www.elsoldemexico.com.mx/deportes/');
        $data = $crawler->filter(".teaser")->each(function($node){
            $sport = array();
            $title = $node->filter(".title > a")->text();
            $enlace = $node->filter(".title > a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $resumen = $node->filter('.summary')->text();
            $sport["diario"] = "el sol de mexico";
            $sport["titulo"] = $title;
            $sport["fecha"] = date("Y:m:d");
            $sport["hora"] = date("G:i:s");
            $sport["resumen"] = $resumen ;
            $sport["categoria"] = "Deportes";
            $sport["url"] = $enlace;
            $sport["img"] = $image;
            $sport["region"] = "nacional";
            $sport["tipo"] = "terciarias";

            return $sport;
        });

        $this->insertData($data);
    }



    // noticias secuandarias

    public function exelsiorRecientes(Client $client){
        $crawler = $client->request('GET', 'https://www.excelsior.com.mx/ultima-hora');
        $data = $crawler->filter(".ultima-hora-content-wrapper > ul > li")->each(function($node){
            $recientes = array();
            $url = "https://www.excelsior.com.mx";
            $title = $node->filter(".ultima-hora-title")->text();
            $enlace = $node->filter("a")->attr("href");
            $resumen = $node->filter(".ultima-hora-summary")->text();
            $image = $node->filter("img")->attr("src");
            $recientes["diario"] = "exelsior";
            $recientes["titulo"] = $title;
            $recientes["fecha"] = date("Y:m:d");
            $recientes["hora"] = date("G:i:s");
            $recientes["resumen"] = "";
             $recientes["categoria"] = "Reciente";
             $recientes["url"] = $enlace;
             $recientes["img"] = $image;
             $recientes["region"] = "nacional";
             $recientes["tipo"] = "secundarias";
            //  var_dump($recientes);
             return $recientes;
        });

        $this->insertData($data);
    }


    public function exelsiorDeportes(Client $client){
        $crawler = $client->request('GET', 'https://www.excelsior.com.mx/ultima-hora');
        $data = $crawler->filter(".ultima-hora-content-wrapper > ul > li")->each(function($node){
            $sports = array();
            $title = $node->filter(".ultima-hora-title")->text();
            $enlace = $node->filter("a")->attr("href");
            $resumen = $node->filter(".ultima-hora-summary")->text();
            $image = $node->filter("img")->attr("src");
            $sports["diario"] = "exelsior";
            $sports["titulo"] = $title;
            $sports["fecha"] = date("Y:m:d");
            $sports["hora"] = date("G:i:s");
            $sports["resumen"] = "";
             $sports["categoria"] = "Deportes";
             $sports["url"] = $enlace;
             $sports["img"] = $image;
             $sports["region"] = "nacional";
             $sports["tipo"] = "secundarias";
            //  var_dump($sports);
            return $sports;
        });

        $this->insertData($data);
    }


    public function elSolDeMexicoSalud(Client $client){
        $crawler = $client->request('GET', 'https://www.elsoldemexico.com.mx/doble-via/salud/');
        $data = $crawler->filter(".teaser")->each(function($node){
            $health = array();

            $title = $node->filter("h4 > a")->text();
            $enlace = $node->filter("h4 > a")->attr("href");
            $resumen = $node->filter(".leadtext")->text("");
            $image = $node->filter("img")->attr("src");
            $health["diario"] = "El sol de mexico";
            $health["titulo"] = $title;
             $health["fecha"] = date("Y:m:d");
             $health["hora"] = date("G:i:s");
             $health["resumen"] = $resumen;
             $health["categoria"] = "Salud";
             $health["url"] = $enlace;
            $health["img"] = $image;
             $health["region"] = "nacional";
             $health["tipo"] = "secundarias";
            // var_dump($resumen);
            return $health;
        });

        $this->insertData($data);
    }


    public function elLaJornadaEconomia(Client $client){

        $crawler = $client->request('GET', "https://www.jornada.com.mx/category/economia.html");
        $data = $crawler->filter(".card-economia")->each(function($node){
            $url = "https://www.jornada.com.mx" ;
            $economy = array();
            $title = $node->filter(".title-default > a ")->text();
            $enlace = $url . "" .$node->filter(".title-default > a")->attr("href");
            $resumen = $node->filter(".card-text > p")->text("");
            $image_name = $node->filter("img")->attr("src");
            $image = strpos($image_name, '/theme') === false ? $image_name : $url ."". $image_name;
            $economy["diario"] = "la jornada";
            $economy["titulo"] = $title;
            $economy["fecha"] = date("Y:m:d");
            $economy["hora"] = date("G:i:s");
            $economy["resumen"] = $resumen;
            $economy["categoria"] = "Economia";
            $economy["url"] = $enlace;
            $economy["img"] = $image;
            $economy["region"] = "nacional";
            $economy["tipo"] = "secundarias";
            return $economy;
        });

        $this->insertData($data);
    }



    public function insertData($newsData){
        $db = new NoticiasModel;
        $db->insertData($newsData);

    }





}
