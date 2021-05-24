<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoticiasModel;

class WebNewsController extends Controller
{
    //

    protected $modelNews;


    public function __construct()
    {
        $this->modelNews = new NoticiasModel;  
    }   
    
    public function Recientes($region){
        $data['recientes'] = $this->modelNews->getNewsRecentToMobile($region);
        return view('public.recientes',$data);
    }

    public function Salud($region){
        $data['salud'] = $this->modelNews->getNewsHealthToMobile($region);
        return view('public.salud',$data);
    }

    public function Economia($region){
        $data['economia'] = $this->modelNews->getNewsEconomyToMobile($region);
        return view('public.economia',$data);
    }

    public function Deportes($region){
        $data['deportes'] = $this->modelNews->getNewsSportsToMobile($region);
        return view('public.deportes',$data);
    }

    public function Covid($region){
        $data['covid'] = $this->modelNews->getNewsCovidoMobile($region);
        return view('public.covid',$data);
    }
}
