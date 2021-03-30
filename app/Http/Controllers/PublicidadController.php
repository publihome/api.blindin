<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\publicidad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\UrlGenerator;

class PublicidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $url;
    public function index()
    {
        //
        $publicidad = new Publicidad;
        $data["anuncios"] = $publicidad->get();

        return view('publicidad.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data = request()->except('_token');
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('uploads','public');
        }
        $data['clicks'] = 0;
        $publicidad = new publicidad;
        $publicidad->add($data);
        return redirect('admin')->with("mensaje", "Anuncio agregado correctamente");
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
        $publicidad = new publicidad;
        $data["anuncio"] = $publicidad->getById($id);
        return view('publicidad.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $publicidad = new publicidad;
        
        $data = request()->except(['_token', '_method']);
        if($request->hasFile('image')){
            $anuncio = $publicidad->getById($id);
            foreach($anuncio as $a){
                Storage::delete('public/'. $a->image);
            }
            $data['image']=$request->file('image')->store('uploads','public');
        }
        $publicidad->updateData($data, $id);
        return redirect('admin')->with('mensaje', 'Anucio actualizado correctamente!');
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
        $publicidad = new publicidad;
        $anuncio = $publicidad->getById($id);
        // var_dump($anuncio);
        // exit;
        foreach($anuncio as $a){
            if(Storage::delete('public/'. $a->image)){
                $publicidad->deleteData($id);
            }
        }
        return redirect('admin')->with('mensaje','Anuncio eliminado');
    }

    public function getAnuncios(){
        $url="http://localhost:8000/storage";
        $publicidad = new Publicidad;
        $data =  $publicidad->get();
         foreach($data as $anuncio){
            $anuncio->image = $url.'/'.$anuncio->image    ;
         }
        // var_dump($data);
        // $data->image = $url .'/'. $data->image;
        return $data;
    }
}
