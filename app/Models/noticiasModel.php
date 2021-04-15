<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NoticiasModel extends Model
{
    use HasFactory;


    public function insertData($newsData){
        if(isset($newsData)){
            if(DB::table("noticias")->get() == ""){
            DB::table('noticias')->insert($newsData);
            }
            foreach ($newsData as $not) {
                # code...
                if (DB::table('noticias')->where('titulo',$not["titulo"] )->doesntExist()) {
                    $data = DB::table('noticias')->insert($not);
                }
            }
        }
    } 

    public function getNewsRecientes($region,$tipo){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Reciente")
            ->where("tipo","=",$tipo)
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(6);
        return json_encode($noticias);
    }


    public function getNewsSports($region, $tipo){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Deportes")
            ->where("tipo","=",$tipo)
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(6);
        return json_encode($noticias);
    }

    public function getNewsHealth($region, $tipo){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Salud")
            ->where("tipo","=",$tipo)
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(6);
        return json_encode($noticias);
    }


    public function getNewsEconomy($region,$tipo){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Economia")
            ->where("tipo","=",$tipo)
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(6);
        return json_encode($noticias);
    }

    public function getNewsCovid($region,$tipo){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Covid")
            ->where("tipo","=",$tipo)
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(12);
        return json_encode($noticias);
    }

    public function searchNew($word){
        $new = DB::table("noticias")
                    ->where("titulo", "like", '%'.$word."%")
                    ->orWhere("resumen", "like", '%'.$word."%")
                    ->orWhere("diario", "like", '%'.$word."%")
                    ->orWhere("region", "like", '%'.$word."%")
                    ->orWhere("tipo", "like", '%'.$word."%")
                    ->orderBy("fecha","desc")
                    ->orderBy("hora","desc")
                    ->paginate(6);
        return json_encode($new);
    }
}
