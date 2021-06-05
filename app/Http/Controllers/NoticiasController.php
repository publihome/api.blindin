<?php

namespace App\Http\Controllers;
use App\Models\NoticiasModel;
use Illuminate\Routing\UrlGenerator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    private $Noticias;
    public function __construct()
    {
        $this->Noticias = new NoticiasModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['noticias'] = $this->Noticias->getNewsBlindin();
        return view('admin.noticias.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.noticias.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $fields = [
            'titulo' => 'required',
            'region' => 'required|string',
            'categoria' => 'required',
            'img' => 'required|mimes:jpeg,png,jpg,gif',
            'resumen' => 'required',
            'texto' => 'required',
        ];
        $message = [
            'required' => 'El :attribute es obligatorio',
            'img.required' => 'La imagen es obligatoria',
            'image.mimes' => 'Este campo dice IMAGEN imbecil'
        ];

        $this->validate($request, $fields, $message);
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
        return redirect('admin/noticias')->with("mensaje", "Noticia agregada correctamente");        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // 
        $data['new'] = $this->Noticias->getById($id);
        return view('admin.noticias.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UrlGenerator $url,Request $request, $id)
    {
        //

        $data = $request->except('_token', '_method');
        if($request->hasFile('img')){
            $new = $this->Noticias->getById($id);
            foreach($new as $n){
                // var_dump( $url->to('/').'/public'.'/'.$n->img);
                Storage::delete('public/'. $n->img);
                
            }
            $data['img'] = $request->file('img')->store('noticias','public');
        }
        $this->Noticias->updateNew($id, $data);
        return redirect('admin/noticias')->with("mensaje", "Noticia editada correctamente");        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->Noticias->deleteNew($id);
        return redirect('admin/noticias')->with("mensaje", "Noticia eliminada correctamente");        

    }
}
