<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\NoticiasModel;


class ScrappingController extends Controller
{
    //

    public function __construct(){
        $db = new NoticiasModel;
    }


    public function searchNew($word){
        $db = new NoticiasModel;
        return $db->searchNew($word);

    }

    public function index(Client $client) {

        $imparcial = $this->imparcial($client);
        $this->imparcialEconomy($client);
        $this->imparcialHealth($client);
        $this->imparcialSports($client);

        $this->rotativo($client);
        $this->rotativoEconomy($client);
        $this->rotativoSports($client);
        $this->milenioHealth($client);

        $this->quadratin($client);
        $this->quadratinSports($client);
        $this->oaxacaEconomy($client);
        $this->oaxacaHealth($client);

        $this->covidOax($client);
    }


    public function imparcial(Client $client) {
        $crawler = $client->request('GET', 'https://imparcialoaxaca.mx/ultima-hora/');

        $data = $crawler->filter(".article-post")->each(function($node) {
            $noticias = array();
            $title = explode("]",$node->filter(".post-content > h2" )->text());
            $titleNew = $title[1];
            $author = $node->filter(".post-content > ul > li")->eq(0)->text();
            $date = $node->filter(".post-content > ul > li")->eq(1)->text();
            $resumen_array = explode("Leer más", $node->filter(".post-content")->text());
            $resumen = $resumen_array[0];
            $enlace = $node->filter(".post-content > a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $textoinfo = explode($date,$resumen);
            $noticias["diario"] = "imparcial";
            $noticias["titulo"] = $titleNew;
            $noticias["fecha"] = date("Y:m:d");
            $noticias["hora"] = date("G:i:s");
            $noticias["resumen"] = trim($textoinfo[1]);
            $noticias["categoria"] = "Reciente";
            $noticias["url"] = $enlace;
            $noticias["img"] = $image;
            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "secundarias";


            return $noticias;

        });
        $this->insertData($data);
     }

     public function imparcialSports(Client $client) {
        $crawler = $client->request("GET", 'https://imparcialoaxaca.mx/super-deportivo/');
        $data = $crawler->filter('.article-post')->each(function($node) {
            $sports = array();
            $title = $node->filter(".post-content > h2")->text();
            $resumen_array = explode("Leer más", $node->filter(".post-content")->text("sin texto"));;
            $resumen = $resumen_array[0];
            $enlace = $node->filter(".post-content > a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $sports["diario"] = "imparcial";
            $sports["titulo"] = $title;
            $sports["fecha"] = date("Y:m:d");
            $sports["hora"] = date("G:i:s");
            $sports["resumen"] = $resumen;
            $sports["categoria"] = "Deportes";
            $sports["url"] = $enlace;
                $sports["img"] = $image;
            $sports["region"] = "oaxaca";
            $sports["tipo"] = "secundarias";


            return $sports;

        });
        $this->insertData($data);
     }

     public function imparcialHealth(Client $client) {
        $crawler = $client->request("GET", 'https://imparcialoaxaca.mx/salud/');
        $data = $crawler->filter('.news-post')->each(function($node) {
            $health = array();
            $title = $node->filter(".post-title > h2")->text();
            $enlace = $node->filter(".post-title > h2 > a")->attr("href");
            $resumen_array = explode("Leer más", $node->filter(".post-content")->text("sin texto"));;
            $resumen = $resumen_array[0];
            $image = $node->filter("img")->attr("src");
            $health["diario"] = "imparcial" ;
            $health["titulo"] = $title;
            $health["fecha"] = date("Y:m:d");
            $health["hora"] = date("G:i:s");
            $health["resumen"] = $resumen;
            $health["categoria"] = "salud";
            $health["url"] = $enlace;
            $health["img"] = $image;
            $health["region"] = "oaxaca";
            $health["tipo"] = "secundarias";
            // var_dump($health);
            return $health;
        });

        $this->insertData($data);
     }



     public function imparcialEconomy(Client $client) {
        $crawler = $client->request("GET", 'https://imparcialoaxaca.mx/economia/');
        $data = $crawler->filter('.news-post')->each(function($node) {
            $economy = array();
            $title = $node->filter(".post-title > h2")->text();
            $enlace = $node->filter(".post-title > h2 > a")->attr("href");
            $resumen_array = explode("Leer más", $node->filter(".post-content")->text("sin texto"));;
            $resumen = $resumen_array[0];
            $image = $node->filter("img")->attr("src");
            // var_dump($resumen);
            // var_dump('<br>');


            $economy["diario"] = "imparcial" ;
            $economy["titulo"] = $title;
            $economy["fecha"] = date("Y:m:d");
            $economy["hora"] = date("G:i:s");
            $economy["resumen"] = $resumen;
            $economy["categoria"] = "Economia";
            $economy["url"] = $enlace;
            $economy["img"] = $image;
            $economy["region"] = "oaxaca";
            $economy["tipo"] = "secundarias";

            return $economy;

            // var_dump($economy);
            // var_dump("<br>");
        });

        $this->insertData($data);
     }





     public function rotativo(Client $client) {
        $crawler = $client->request('GET', 'http://www.rotativooaxaca.com.mx/');
        $data =  $crawler->filter('.category-mas-informacion')->each(function($node) {
            $noticias = array();

            $title = $node->filter(".post-title > a")->text();
            $resumen = $node->filter(".entry > p")->text();
            $enlace = $node->filter(".entry > a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $noticias["titulo"] = $title;
            $noticias["resumen"] = $resumen;
            $noticias["categoria"] = "Reciente";
            $noticias["fecha"] = date("Y:m:d");
            $noticias["diario"] = "rotativo";
            $noticias["hora"] = date("G:i:s");
            $noticias["tipo"] = "primarias";

            $noticias["url"] = $enlace;
            $noticias["img"] = $image;
            $noticias["region"] = "oaxaca";


            return $noticias;
        });
        $this->insertData($data);

    }


    
    public function rotativoEconomy(Client $client) {
        $crawler = $client->request('GET', 'https://laverdadnoticias.com/seccion/economia/');
        $data =  $crawler->filter('.news--252x142')->each(function($node) {
            $noticias = array();
            $url = "https://laverdadnoticias.com";

            $title = $node->filter(".news__title")->text();
            $resumen = $node->filter(".news__excerpt > p")->text();
            $enlace = $url.''.$node->filter(".news__title > a")->attr("href");
            $image = $url.''.$node->filter("img")->attr("src");
            $noticias["titulo"] = $title;
            $noticias["resumen"] = $resumen;
            $noticias["categoria"] = "Economia";
            $noticias["fecha"] = date("Y:m:d");
            $noticias["diario"] = "el la verdad noticias";
            $noticias["hora"] = date("G:i:s");
            $noticias["tipo"] = "primarias";
            $noticias["url"] = $enlace;
            $noticias["img"] = $image;
            $noticias["region"] = "oaxaca";
            // var_dump($noticias);
            return $noticias;
        });
        $this->insertData($data);

    }


    public function rotativoSports(Client $client) {
        $crawler = $client->request("GET", "https://tmbinfo.com/category/deportes/");
        $data = $crawler->filter(".item-list")->each(function ($node) {
            $sports = array();
            $title = $node->filter(".post-title")->text();
            $resumen = $node->filter(".entry > p")->text();
            $enlace = $node->filter(".post-thumbnail > a")->attr("href");
            $image = $node->filter("img")->attr("src");

            $sports["tipo"] = "primarias";
            $sports["titulo"] = $title;
            $sports["resumen"] = $resumen;
            $sports["categoria"] = "Deportes";
            $sports["fecha"] = date("Y:m:d");
            $sports["diario"] = "tmbinfo";
            $sports["hora"] = date("G:i:s");
            $sports["url"] = $enlace;
            $sports["img"] = $image;
            $sports["region"] = "oaxaca";
            return $sports;
        });

        $this->insertData($data);
    }



    public function milenioHealth(Client $client) {
        $crawler = $client->request("GET", "https://www.milenio.com/temas/secretaria-de-salud-oaxaca");
        $data = $crawler->filter(".lr-row-news")->each(function ($node) {
            $health = array();
            $url = "https://www.milenio.com";
            $title = $node->filter(".title > a > h2")->text();
            $resumen = $node->filter(".summary > span")->text();
            $enlace = $url ."". $node->filter(".title > a")->attr("href");
            $image = $url ."". $node->filter('img')->attr("data-lazy");
            // var_dump($title);

            $health["titulo"] = $title;
            $health["resumen"] = $resumen;
            $health["categoria"] = "Salud";
            $health["fecha"] = date("Y:m:d");
            $health["diario"] = "milenio";
            $health["hora"] = date("G:i:s");
            $health["url"] = $enlace;
            $health["img"] = $image;
            $health["region"] = "oaxaca";
            $health["tipo"] = "primarias";

            // var_dump($health);
            return $health;
        });
        $this->insertData($data);
    }

    public function quadratin(Client $client) {
        $crawler = $client->request('GET', 'https://www.rioaxaca.com/category/estado-general/estado-locales/');
        $data =  $crawler->filter('.td_module_11 ')->each(function($node) {
            $noticias = array();
            $url = "https://www.nvinoticias.com";

            $title = $node->filter(".entry-title > a")->text();
            $enlace = $node->filter(".entry-title > a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $resumen = $node->filter(".td-excerpt")->text();
            $noticias["hora"] = date("G:i:s");
            $noticias["fecha"] = date("Y:m:d");
            $noticias["titulo"] = $title;
            $noticias["diario"] = "rioaxaca";
            $noticias["resumen"] = $resumen;
            $noticias["url"] = $enlace;
            $noticias["img"] = $image;
            $noticias["categoria"] = "Reciente";
            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "terciarias";
            // var_dump($noticias);

             return $noticias;
        });

        $this->insertData($data);
    }

    // public function tiempo(Client $client) {
    //     $crawler = $client->request('GET', 'https://tiempodigital.mx/category/secciones/oaxaca/');
    //     $data =  $crawler->filter('.td_module_1')->each(function($node) {
    //         $noticias = array();

    //         $title = $node->filter(".entry-title")->text();
    //         $enlace = $node->filter(".entry-title > a")->attr("href");
    //         $image = $node->filter("img")->attr("src");
    //         $noticias["hora"] = date("G:i:s");
    //         $noticias["fecha"] = date("Y:m:d");
    //         $noticias["titulo"] = $title;
    //         $noticias["diario"] = "tiempo";
    //         $noticias["resumen"] = "";
    //         $noticias["url"] = $enlace;
    //         $noticias["img"] = $image;
    //         $noticias["categoria"] = "Reciente";
    //         $noticias["region"] = "oaxaca";
    //         $noticias["tipo"] = "terciarias";


    //         var_dump($noticias);

    //          return $noticias;
    //     });

    //      $this->insertData($data);
    // }

    // public function quadratinSports(Client $client) {
    //     $crawler = $client->request('GET', 'https://oaxaca.quadratin.com.mx/deportes/');
    //     $data =  $crawler->filter('.col-lg-6')->each(function($node) {
    //         $noticias = array();

    //         $title = $node->filter(".box-content > a > h4")->text();
    //         $enlace = $node->filter(".box-content > a")->attr("href");
    //         $image = $node->filter("img")->attr("src");
    //         $resumen = $node->filter(".box-content > a > p")->text();
    //         $noticias["hora"] = date("G:i:s");
    //         $noticias["fecha"] = date("Y:m:d");
    //         $noticias["titulo"] = $title;
    //         $noticias["diario"] = "quadratin";
    //         $noticias["resumen"] = $resumen;
    //         $noticias["url"] = $enlace;
    //         $noticias["img"] = $image;
    //         $noticias["categoria"] = "Deportes";
    //         $noticias["region"] = "oaxaca";
    //         $noticias["tipo"] = "terciarias";


    //         // var_dump($noticias);

    //          return $noticias;
    //     });

    //     $this->insertData($data);
    // }

    public function quadratinSports(Client $client) {
        $crawler = $client->request('GET', 'https://www.encuentroradiotv.com/index.php/deportes');
        $data =  $crawler->filter('.itemContainer')->each(function($node) {
            $noticias = array();
            $url="https://www.encuentroradiotv.com";

            $title = $node->filter(".catItemTitle > a")->text();
            $enlace = $url .''.$node->filter(".catItemTitle > a")->attr("href");
            $resumen = $node->filter(".catItemIntroText")->text();
            $image = $url .''.$node->filter("img")->attr("src");
            $noticias["hora"] = date("G:i:s");
            $noticias["fecha"] = date("Y:m:d");
            $noticias["titulo"] = $title;
            $noticias["diario"] = "encuentro";
            $noticias["resumen"] = $resumen;
            $noticias["url"] = $enlace;
            $noticias["img"] = $image;
            $noticias["categoria"] = "Deportes";
            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "terciarias";

            // var_dump($noticias);

             return $noticias;
        });

        $this->insertData($data);
    }


    // public function tiempoSports(Client $client) {
    //     $crawler = $client->request('GET', 'https://tiempodigital.mx/category/secciones/deportes/');
    //     $data =  $crawler->filter('.td_module_1')->each(function($node) {
    //         $sports = array();

    //         $title = $node->filter(".entry-title")->text();
    //         $enlace = $node->filter(".entry-title > a")->attr("href");
    //         $image = $node->filter("img")->attr("src");
    //         $sports["hora"] = date("G:i:s");
    //         $sports["fecha"] = date("Y:m:d");
    //         $sports["titulo"] = $title;
    //         $sports["diario"] = "tiempo";
    //         $sports["resumen"] = "";
    //         $sports["url"] = $enlace;
    //         $sports["img"] = $image;
    //         $sports["categoria"] = "Deportes";
    //         $sports["region"] = "oaxaca";
    //         $sports["tipo"] = "terciarias";

    //         return $sports;
    //     });

    //     $this->insertData($data);
    // }

    public function oaxacaEconomy(Client $client) {
        $crawler = $client->request('GET', 'https://www.encuentroradiotv.com/index.php/finanzas');
        $data =  $crawler->filter('.itemContainer')->each(function($node) {
            $noticias = array();
            $url="https://www.encuentroradiotv.com";

            $title = $node->filter(".catItemTitle > a")->text();
            $enlace = $url .''.$node->filter(".catItemTitle > a")->attr("href");
            $resumen = $node->filter(".catItemIntroText")->text();
            $image = $url .''.$node->filter("img")->attr("src");
            $noticias["hora"] = date("G:i:s");
            $noticias["fecha"] = date("Y:m:d");
            $noticias["titulo"] = $title;
            $noticias["diario"] = "encuentro";
            $noticias["resumen"] = $resumen;
            $noticias["url"] = $enlace;
            $noticias["img"] = $image;
            $noticias["categoria"] = "Economia";
            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "terciarias";

            // var_dump($image);

             return $noticias;
        });

        $this->insertData($data);
    }



    public function oaxacaHealth(Client $client) {
        $crawler = $client->request('GET', 'https://presslibre.mx/category/noticias/salud/');
        $data =  $crawler->filter('.type-post')->each(function($node) {
            $noticias = array();

            $title = $node->filter(".entry-title > a")->text();
            $enlace = $node->filter(".entry-title > a")->attr("href");
            $resumen = $node->filter(".entry-content > p")->text();
            $image = $node->filter("img")->attr("src");
            $noticias["hora"] = date("G:i:s");
            $noticias["fecha"] = date("Y:m:d");
            $noticias["titulo"] = $title;
            $noticias["diario"] = "presslibre";
             $noticias["resumen"] = $resumen;
             $noticias["url"] = $enlace;
            $noticias["img"] = $image;
            $noticias["categoria"] = "Salud";
             $noticias["region"] = "oaxaca";
             $noticias["tipo"] = "terciarias";

            // var_dump($noticias);

             return $noticias;
        });

        $this->insertData($data);
    }


    // public function tiempoHealth(Client $client) {
    //     $crawler = $client->request('GET', 'https://tiempodigital.mx/category/salud/');
    //     $data =  $crawler->filter('.td_module_1')->each(function($node) {
    //         $health = array();

    //         $title = $node->filter(".entry-title")->text();
    //         $enlace = $node->filter(".entry-title > a")->attr("href");
    //         $image = $node->filter("img")->attr("src");
    //         $health["hora"] = date("G:i:s");
    //         $health["fecha"] = date("Y:m:d");
    //         $health["titulo"] = $title;
    //         $health["diario"] = "tiempo";
    //         $health["resumen"] = "";
    //         $health["url"] = $enlace;
    //         $health["img"] = $image;
    //         $health["categoria"] = "Salud";
    //         $health["region"] = "oaxaca";
    //         $health["tipo"] = "terciarias";

    //         return $health;

    //     });

    //     $this->insertData($data);
    // }


    // public function tiempoEconomy(Client $client) {
    //     $crawler = $client->request('GET', 'https://tiempodigital.mx/category/secciones/finanzas/');
    //     $data =  $crawler->filter('.td_module_1')->each(function($node) {
    //         $economy = array();

    //         $title = $node->filter(".entry-title")->text();
    //         $enlace = $node->filter(".entry-title > a")->attr("href");
    //         $image = $node->filter("img")->attr("src");
    //         $economy["hora"] = date("G:i:s");
    //         $economy["fecha"] = date("Y:m:d");
    //         $economy["titulo"] = $title;
    //         $economy["diario"] = "tiempo";
    //         $economy["resumen"] = "";
    //         $economy["url"] = $enlace;
    //         $economy["img"] = $image;
    //         $economy["categoria"] = "Economia";
    //         $economy["region"] = "oaxaca";
    //         $economy["tipo"] = "terciarias";
    //         // var_dump($economy);
    //         return $economy;
    //     });

    //     $this->insertData($data);
    // }


    public function covidOax(Client $client) {
        $crawler = $client->request('GET', 'https://imparcialoaxaca.mx/salud/coronavirus/');

        $data = $crawler->filter(".standard-post2")->each(function($node) {
            $noticias = array();
            $title = $node->filter(".post-title > h2 > a" )->text();
            $resumen = $node->filter(".post-content")->text("");
            $enlace = $node->filter(".post-title >h2> a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $noticias["diario"] = "imparcial";
            $noticias["titulo"] = $title;
            $noticias["fecha"] = date("Y:m:d");
            $noticias["hora"] = date("G:i:s");
            $noticias["resumen"] = trim($resumen);
            $noticias["categoria"] = "Covid";
            $noticias["url"] = $enlace;
            $noticias["img"] = $image;
            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "primarias";
            var_dump($noticias);
            return $noticias;

        });
        $this->insertData($data);
     }




    public function insertData($newsData){
        $db = new NoticiasModel;
        $db->insertData($newsData);
    }

}
