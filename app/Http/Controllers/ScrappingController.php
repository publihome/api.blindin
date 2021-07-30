<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Goutte\Client;
use App\Models\NoticiasModel;


class ScrappingController extends Controller
{
    //

        private $count = 0;
    public function __construct(){
        $db = new NoticiasModel;
    }


    public function searchNew($word){
        $db = new NoticiasModel;
        return $db->searchNew($word);

    }

    public function index(Client $client) {

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

    public function oaxaca2(Client $client){

        $this->imparcial($client);
        $this->imparcialEconomy($client);
        $this->imparcialHealth($client);
        $this->imparcialSports($client);

    }

    public function imparcial(Client $client) {
        $crawler = $client->request('GET', 'https://imparcialoaxaca.mx/ultima-hora');
        $data = $crawler->filter(".article-post")->each(function($node) {
            $noticias = array();
            $resumen_array = explode("Leer más", $node->filter(".post-content")->text());
            $resumen = $resumen_array[0];
            $enlace = $node->filter(".post-content > a")->attr("href");
            $textoinfo = explode("]",$resumen);
            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.single-post-box');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });
            $noticias["titulo"] = $dataContent->filter('.title-post > h1')->text();
            $noticias["img"] = $dataContent->filter('.size-full')->attr("src");
            $noticias["texto"] = json_encode($contentNew);
            $noticias["diario"] = "imparcial";
            $noticias["fecha"] = date("Y:m:d");
            $noticias["hora"] = date("G:i:s");
            $noticias["resumen"] = trim($textoinfo[1]);
            $noticias["categoria"] = "Reciente";
            $noticias["url"] = $enlace;
            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "secundarias";


            return $noticias;

        });
        $this->insertData($data);
     }

    

     public function imparcialSports(Client $client) {
        $crawler = $client->request("GET", 'https://imparcialoaxaca.mx/super-deportivo/');
        $data = $crawler->filter('.article-post')->siblings()->each(function($node) {

            $sports = array();

            $resumen = $node->filter(".post-tags")->text("sin texto");
            $enlace = $node->filter(".post-content > h2 > a")->attr("href");
            $title = $node->filter(".post-content > h2 > a")->text();
            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.the-content');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });

            $sports["titulo"] = $title;
            $sports["img"] = $scrap->filter('figure > img')->attr("src");
            $sports["texto"] = json_encode($contentNew);
            $sports["diario"] = "imparcial";
            $sports["fecha"] = date("Y:m:d");
            $sports["hora"] = date("G:i:s");
            $sports["resumen"] = $resumen;
            $sports["categoria"] = "Deportes";
            $sports["url"] = $enlace;
            $sports["region"] = "oaxaca";
            $sports["tipo"] = "secundarias";

            // var_dump($sports);
            return $sports;

        });
        $this->insertData($data);
     }

     public function imparcialHealth(Client $client) {
        $crawler = $client->request("GET", 'https://imparcialoaxaca.mx/salud/');
        $data = $crawler->filter('.standard-post2')->each(function($node) {
            $health = array();
            $enlace = $node->filter(".post-title > h2 > a")->attr("href");
            $resumen_array = explode("Leer más", $node->filter(".post-content")->text("sin texto"));;
            $resumen = $resumen_array[0];
            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.single-post-box');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });

            $health["titulo"] = $dataContent->filter('.title-post > h1')->text();
            $health["img"] = $dataContent->filter('.size-full')->attr("src");
            $health["texto"] = json_encode($contentNew);

            $health["diario"] = "imparcial" ;
            $health["fecha"] = date("Y:m:d");
            $health["hora"] = date("G:i:s");
            $health["resumen"] = $resumen;
            $health["categoria"] = "salud";
            $health["url"] = $enlace;
            $health["region"] = "oaxaca";
            $health["tipo"] = "secundarias";
            // var_dump($health);
            return $health;
        });

        $this->insertData($data);
     }



     public function imparcialEconomy(Client $client) {
        $crawler = $client->request("GET", 'https://imparcialoaxaca.mx/economia/');
        $data = $crawler->filter('.standard-post2')->each(function($node) {
            $economy = array();
            $enlace = $node->filter(".post-title > h2 > a")->attr("href");
            $resumen_array = explode("Leer más", $node->filter(".post-content")->text("sin texto"));;
            $resumen = $resumen_array[0];
            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.single-post-box');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });

            $economy["titulo"] = $dataContent->filter('.title-post > h1')->text();
            $economy["img"] = $dataContent->filter('.size-full')->attr("src");
            $economy["texto"] = json_encode($contentNew);

            $economy["diario"] = "imparcial" ;
            $economy["fecha"] = date("Y:m:d");
            $economy["hora"] = date("G:i:s");
            $economy["resumen"] = $resumen;
            $economy["categoria"] = "Economia";
            $economy["url"] = $enlace;
            $economy["region"] = "oaxaca";
            $economy["tipo"] = "secundarias";

            // var_dump($economy);
            return $economy;
            // var_dump("<br>");
        });

        $this->insertData($data);
     }





     public function rotativo(Client $client) {
        $crawler = $client->request('GET', 'http://www.rotativooaxaca.com.mx/');
        $data =  $crawler->filter('.category-mas-informacion')->each(function($node) {
            $noticias = array();
            $resumen = $node->filter(".entry > p")->text();
            $enlace = $node->filter(".entry > a")->attr("href");

            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.primary');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });

            $noticias["titulo"] = $dataContent->filter('.post-title')->text();
            $noticias["img"] = $dataContent->filter('.size-medium')->attr("src");
            $noticias["texto"] = json_encode($contentNew);

            $noticias["resumen"] = $resumen;
            $noticias["categoria"] = "Reciente";
            $noticias["fecha"] = date("Y:m:d");
            $noticias["diario"] = "rotativo";
            $noticias["hora"] = date("G:i:s");
            $noticias["tipo"] = "primarias";
            $noticias["url"] = $enlace;
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

            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.newsfull__body');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });

            $noticias["titulo"] = $title;

            $noticias["img"] = $image;
            $noticias["texto"] = json_encode($contentNew);
            $noticias["resumen"] = $resumen;
            $noticias["categoria"] = "Economia";
            $noticias["fecha"] = date("Y:m:d");
            $noticias["diario"] = "la verdad noticias";
            $noticias["hora"] = date("G:i:s");
            $noticias["tipo"] = "primarias";
            $noticias["url"] = $enlace;
            $noticias["region"] = "oaxaca";
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

            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.entry');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });
            $sports["texto"] = json_encode($contentNew);
            $sports["tipo"] = "primarias";
            $sports["titulo"] = $title;
            $sports["resumen"] = $resumen;
            $sports["categoria"] = "Deportes";
            $sports["fecha"] = date("Y:m:d");
            $sports["diario"] = "tmbinfo";
            $sports["hora"] = date("G:i:s");
            $sports["url"] = $enlace;
            $sports["img"] = $scrap->filter('.single-post-thumb > img')->attr('src');
            $sports["region"] = "oaxaca";
            // var_dump($sports);
            return $sports;
        });

        $this->insertData($data);
    }

/* cambiar esta noticia ya es muy vieja */

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
            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.content-body');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });

            $health["titulo"] = $title;
            $health["texto"] = json_encode($contentNew);
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

/** fin de noticia */

    public function quadratin(Client $client) {
        $crawler = $client->request('GET', 'https://www.rioaxaca.com/category/estado-general/estado-locales/');
        $data =  $crawler->filter('.td_module_11 ')->each(function($node) {
            $noticias = array();

            $title = $node->filter(".entry-title > a")->text();
            $enlace = $node->filter(".entry-title > a")->attr("href");
            $image = $node->filter("img")->attr("src");
            $resumen = $node->filter(".td-excerpt")->text();

            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.td-post-content');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });

            $noticias["texto"] = json_encode($contentNew);
            $noticias["hora"] = date("G:i:s");
            $noticias["fecha"] = date("Y:m:d");
            $noticias["titulo"] = $title;
            $noticias["diario"] = "rioaxaca";
            $noticias["resumen"] = $resumen;
            $noticias["url"] = $enlace;
            $noticias["img"] = $dataContent->filter('.entry-thumb')->attr('src');
            $noticias["categoria"] = "Reciente";
            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "terciarias";
            // var_dump($noticias);

            return $noticias;
        });

        $this->insertData($data);
    }


    /******************** me quede en la anterior ******************** */

    public function quadratinSports(Client $client) {
        $crawler = $client->request('GET', 'https://www.encuentroradiotv.com/index.php/deportes');
        $data =  $crawler->filter('.itemContainer')->each(function($node) {
            $noticias = array();
            $url="https://www.encuentroradiotv.com";

            $title = $node->filter(".catItemTitle > a")->text();
            $enlace = $url .''.$node->filter(".catItemTitle > a")->attr("href");
            $resumen = $node->filter(".catItemIntroText")->text();
            $image = $url .''.$node->filter("img")->attr("src");

            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.itemFullText');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });
            $noticias["texto"] = json_encode($contentNew);
            $noticias["hora"] = date("G:i:s");
            $noticias["fecha"] = date("Y:m:d");
            $noticias["titulo"] = $title;
            $noticias["diario"] = "encuentro";
            $noticias["resumen"] = $resumen;
            $noticias["url"] = $enlace;
            $noticias["img"] = $url.''.$scrap->filter('.itemImage > a > img')->attr('src');
            $noticias["categoria"] = "Deportes";
            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "terciarias";

            // var_dump($noticias);

            return $noticias;
        });

        $this->insertData($data);
    }



    public function oaxacaEconomy(Client $client) {
        $crawler = $client->request('GET', 'https://www.encuentroradiotv.com/index.php/finanzas');
        $data =  $crawler->filter('.itemContainer')->each(function($node) {
            $noticias = array();
            $url="https://www.encuentroradiotv.com";

            $title = $node->filter(".catItemTitle > a")->text();
            $enlace = $url .''.$node->filter(".catItemTitle > a")->attr("href");
            $resumen = $node->filter(".catItemIntroText")->text();
            $image = $url .''.$node->filter("img")->attr("src");
            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.itemFullText');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });
            $noticias["texto"] = json_encode($contentNew);
            $noticias["hora"] = date("G:i:s");
            $noticias["fecha"] = date("Y:m:d");
            $noticias["titulo"] = $title;
            $noticias["diario"] = "encuentro";
            $noticias["resumen"] = $resumen;
            $noticias["url"] = $enlace;
            $noticias["img"] = $url.''.$scrap->filter('.itemImage > a > img')->attr('src');
            $noticias["categoria"] = "Economia";
            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "terciarias";

            // var_dump($noticias);

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
            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.entry-content');
            $contentNew = $dataContent->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });
            $noticias["texto"] = json_encode($contentNew);

            $noticias["hora"] = date("G:i:s");
            $noticias["fecha"] = date("Y:m:d");
            $noticias["titulo"] = $title;
            $noticias["diario"] = "presslibre";
             $noticias["resumen"] = $resumen;
             $noticias["url"] = $enlace;
            $noticias["img"] = $scrap->filter('.attachment-colormag-featured-image')->attr('src');
            $noticias["categoria"] = "Salud";
             $noticias["region"] = "oaxaca";
             $noticias["tipo"] = "terciarias";

            // var_dump($noticias);

            return $noticias;
        });

        $this->insertData($data);
    }


    public function covidOax(Client $client) {
        $crawler = $client->request('GET', 'https://imparcialoaxaca.mx/salud/coronavirus/');

        $data = $crawler->filter(".standard-post2")->each(function($node) {
            $noticias = array();
            $title = $node->filter(".post-title > h2 > a" )->text();
            $resumen = $node->filter(".post-content")->text("");
            $enlace = $node->filter(".post-title >h2> a")->attr("href");
            // $image = $node->filter("img")->attr("src");

            $client = new Client();
            $scrap = $client->request('GET', $enlace);
            $dataContent = $scrap->filter('.single-post-box');
            $dataContentText = $scrap->filter('.the-content');
            $contentNew = $dataContentText->filter('p')->each(function($textnew){
                return  $textnew->filter('p')->text();
            });
            $noticias["texto"] = json_encode($contentNew);
            $noticias["diario"] = "imparcial";
            $noticias["titulo"] = $title;
            $noticias["fecha"] = date("Y:m:d");
            $noticias["hora"] = date("G:i:s");
            $noticias["resumen"] = trim($resumen);
            $noticias["categoria"] = "Covid";
            $noticias["url"] = $enlace;
            $noticias["img"] = $dataContent->filter('.size-full')->attr("src");

            $noticias["region"] = "oaxaca";
            $noticias["tipo"] = "primarias";
            // var_dump($noticias);
            return $noticias;

        });
        $this->insertData($data);
     }




    public function insertData($newsData){
        $db = new NoticiasModel;
        $db->insertData($newsData);

    }

}
