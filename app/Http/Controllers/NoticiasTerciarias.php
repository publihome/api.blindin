<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ScrappingController;
use App\Models\NoticiasModel;

class NoticiasTerciarias extends Controller
{

    public $tipo = "terciarias";

    public function index($region) {
        $db = new NoticiasModel;
        return $db->getNewsRecientes($region, $this->tipo);
    }

    public function sports($region) {
        $db = new NoticiasModel;
        return $db->getNewsSports($region, $this->tipo);
    }

    public function health($region) {
        $db = new NoticiasModel;
        return $db->getNewsHealth($region, $this->tipo);
    }

    public function economy($region) {
        $db = new NoticiasModel;
        return $db->getNewsEconomy($region, $this->tipo);
    }
}
