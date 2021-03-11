<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ScrappingController;
use App\Models\NoticiasModel;
use Goutte\Client;


class NoticiasSecundarias extends Controller
{
    

    public $tipo = "secundarias";

    public function index($region) {
        $db = new NoticiasModel;  
        return $db->getNewsRecientes($region,$this->tipo);

    }

    public function sports($region) {
        $db = new NoticiasModel;  
        return $db->getNewsSports($region,$this->tipo);

    }

    public function health($region) {
        $db = new NoticiasModel;  
        return $db->getNewsHealth($region,$this->tipo);
    }

    public function economy($region) {
        $db = new NoticiasModel;  
        return $db->getNewsEconomy($region,$this->tipo);
    }
}
