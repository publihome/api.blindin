<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




class publicidad extends Model
{
    use HasFactory;


    public function add($data){
        DB::table('anuncios')->insert($data);

    }

    public function get(){
            return DB::table('anuncios')->get();
    }

    public function getAdds($ubicacion){
        
        return DB::table('anuncios')
                ->where('position','=', $ubicacion)
                ->get();
    }

    public function getById($id){
        return DB::table('anuncios')->where("id", $id)->get();
    }

    public function deleteData($id){
        return DB::table('anuncios')->where("id", $id)->delete();
    }


    public function updateData($data, $id){
        return DB::table('anuncios')
                    ->where("id", $id)
                    ->update($data);
    }

    public function setClick($id){
        DB::table('anuncios')
            ->where('id',$id)
            ->increment('clicks', 1);
    }

}
