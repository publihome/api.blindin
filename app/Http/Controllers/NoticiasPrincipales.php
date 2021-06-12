<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ScrappingController;
use App\Models\NoticiasModel;


class NoticiasPrincipales extends Controller
{
    //
    public $tipo = "primarias";
    private $db;
    public function __construct(){
        $this->db = new NoticiasModel;
    }


    public function index($region){
        return $this->db->getNewsRecientes($region,$this->tipo);
    }

    public function sports($region){
        return $this->db->getNewsSports($region,$this->tipo);
    }

    public function health($region){
        return $this->db->getNewsHealth($region,$this->tipo);
    }

    public function economy($region){
        return $this->db->getNewsEconomy($region,$this->tipo);
    }

    public function getCovidNews($region){
        return $this->db->getNewsCovid($region, $this->tipo);
    }


    //controllres to mobile

    public function RecentMobile($region){
        return $this->db->getNewsRecentToMobile($region);

    }

    public function HealthMobile($region){
        return $this->db->getNewsHealthToMobile($region);
        
    }

    public function EconomyMobile($region){
        return $this->db->getNewsEconomyToMobile($region);
        
    }

    public function getNewById($idNew){
        return $this->db->getNewById($idNew);
    }

    public function SportsMobile($region){
        return $this->db->getNewsSportsToMobile($region);
        
    }

    public function covidMobile($region){
        return $this->db->getNewsCovidToMobile($region);
        
    }

    

    
}
