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

        return view('admin.publicidad.index',$data);
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
        $fields = [
            'nombreMarca' => 'required|string',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'url' => 'required',
            'position' => 'required',
        ];
        $message = [
            'required' => 'El :attribute es requerido',
            'image.required' => 'La foto es requerida',
            'image.mimes' => 'Este campo dice IMAGEN imbecil'
        ];

        $this->validate($request, $fields, $message);
        $data = request()->except('_token');
        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('uploads','public');
            
        }
        $data['clicks'] = 0;
        $publicidad = new publicidad;
        $publicidad->add($data);
        return redirect('admin/publicidad')->with("mensaje", "Anuncio agregado correctamente");
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
        return view('admin.publicidad.edit',$data);

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
        $fields = [
            'nombreMarca' => 'required|string',
            'url' => 'required|string',
            'position' => 'required|string',
        ];
        $message = [
            'required' => 'El :attribute es requerido',
        ];


        $publicidad = new publicidad;
        
        $data = request()->except(['_token', '_method']);
        if($request->hasFile('image')){
            $message= [
                'Foto.required' => 'La foto es requerida'
            ];
            $fields = [
            'image' => 'required|mimes:jpeg,png,jpg'
            ];

            $anuncio = $publicidad->getById($id);
            foreach($anuncio as $a){
                Storage::delete('public/'. $a->image);
            }
            $data['image']=$request->file('image')->store('uploads','public');
        }
        $this->validate($request, $fields, $message);

        $publicidad->updateData($data, $id);
        return redirect('admin/publicidad')->with('mensaje', 'Anucio actualizado correctamente!');
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
        return redirect('admin/publicidad')->with('mensaje','Anuncio eliminado');
    }

    public function getAddsForApi(UrlGenerator $url, $ubicacion){
        $urlbase = $url;
        $publicidad = new Publicidad;
        $data =  $publicidad->getAdds($ubicacion);
         foreach($data as $anuncio){
            $anuncio->image = $urlbase->to('/storage').'/'.$anuncio->image;
         }
        return json_encode($data);
    }

    public function getAdds(UrlGenerator $url, $ubicacion){
        $publicidad = new Publicidad;
        $data =  $publicidad->getAdds($ubicacion);
        return ($data);
    }

    public function setClick($id){
        $add = new publicidad;
        $add->setClick($id);

    }
}
