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
            foreach ($newsData as $not) {
                if($not['img'] !== "without image" || $not['texto'] !== "[]" ){
                    if (DB::table('noticias')->where('titulo',$not["titulo"] )->doesntExist()) {
                        DB::table('noticias')->insert($not);
                    }
                }else{
                    var_dump($not["img"]);
                }
            }
         }
    } 

    public function saveNew($new){
        DB::table('noticias')->insert($new);
    }

    public function getById($idNew){
        $sql = DB::table('noticias')
            ->where('id',"=",$idNew)
            ->get();
        return $sql;
    }

    public function getNewsBlindin(){
        $noticias = DB::table('noticias')
            ->where('diario', "=", 'blindin')
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->get();

        return $noticias;
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
                    ->paginate(22);
        return json_encode($new);
    }

    //consultas para mobile


    public function getNewsRecentToMobile($region){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Reciente")
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(22);
        return json_encode($noticias);
    }

    public function getNewsHealthToMobile($region){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Salud")
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(22);
        return json_encode($noticias);
    }

    public function getNewsEconomyToMobile($region){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Economia")
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(22);
        return json_encode($noticias);
    }

    public function getNewsSportsToMobile($region){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Deportes")
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(22);
        return json_encode($noticias);
    }

    public function getNewsCovidoMobile($region){
        $noticias = DB::table("noticias")
            ->where("region","=",$region)
            ->where("categoria","=","Covid")
            ->orderBy("fecha","desc")
            ->orderBy("hora","desc")
            ->paginate(12);
        return json_encode($noticias);
    }

    public function updateNew($id, $data){
        DB::table('noticias')->where('id', $id)->update($data);
    }

    public function deleteNew($idNew){
        if (DB::table('noticias')->where('id', $idNew)->exists()) {
            DB::table('noticias')->where('id', "=", $idNew)->delete();
        }
    }

    public function getNewById($idNew){
        if (DB::table('noticias')->where('id', $idNew)->exists()) {
            return DB::table('noticias')->where('id',$idNew)->get();
        }else{
            return "no existe id";
        }
    }


    
}
