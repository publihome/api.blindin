<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class noticiasModel extends Model
{
    use HasFactory;



    public function saveNew($data){
        if($data){
            var_dump($data);
            DB::table('noticias')->insert($data);
            
        }

    }


    public function getnews(){
        DB::table('noticias')->get();


    }
}
