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
    
    public function Recientes(){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Recientes";
        return view('public.recientes',$data);
    }

    public function Salud(){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Salud";
        return view('public.salud',$data);
    }

    public function Economia(){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Economia";
        return view('public.economia',$data);
    }

    public function Deportes(){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Deportes";
        return view('public.deportes',$data);
    }

    public function Covid(){
        $data['addsTop'] = $this->publicidad->getAdds('top');
        $data['addsBottom'] = $this->publicidad->getAdds('down');
        $data['sectionName'] = "Covid";
        return view('public.covid',$data);
    }
}
