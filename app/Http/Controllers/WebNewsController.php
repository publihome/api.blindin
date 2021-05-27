<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoticiasModel;
use App\Models\publicidad;

class WebNewsController extends Controller
{
    //

    protected $modelNews;
    protected $publicidad;


    public function __construct()
    {
        $this->modelNews = new NoticiasModel;  
        $this->publicidad = new publicidad;  
    }   
    
    public function Recientes($region){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Recientes";
        $data['recientes'] = $this->modelNews->getNewsRecentToMobile($region);
        return view('public.recientes',$data);
    }

    public function Salud($region){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Salud";
        $data['salud'] = $this->modelNews->getNewsHealthToMobile($region);
        return view('public.salud',$data);
    }

    public function Economia($region){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Economia";
        $data['economia'] = $this->modelNews->getNewsEconomyToMobile($region);
        return view('public.economia',$data);
    }

    public function Deportes($region){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Deportes";
        $data['deportes'] = $this->modelNews->getNewsSportsToMobile($region);
        return view('public.deportes',$data);
    }

    public function Covid($region){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Covid";
        $data['covid'] = $this->modelNews->getNewsCovidoMobile($region);
        return view('public.covid',$data);
    }
}
