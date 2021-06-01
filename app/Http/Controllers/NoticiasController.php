<?php

namespace App\Http\Controllers;

use App\Models\NoticiasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiasController extends Controller
{
    //
    private $Noticias;

    public function __construct()
    {
        $this->Noticias = new NoticiasModel;
    }

    public function index(){
        return view('admin.noticias.index');
    }

    public function add(){
        return view('admin.noticias.add');
    }

    public function store(Request $request){
        $data = $request->except('_token');
        if($request->hasFile('img')){
            $data['img'] = $request->file('img')->store('noticias','public');
        }
        $data["hora"] = date("G:i:s");
        $data["fecha"] = date("Y:m:d");
        $data["diario"] = "Blindin";
        $data["url"] = "";
        $data["tipo"] = "primarias";
        $this->Noticias->saveNew($data);
        return redirect('admin')->with("mensaje", "Anuncio agregado correctamente");        
    }
}
