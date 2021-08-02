<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlterEnvController extends Controller
{
    //
    public function alterEnv(array $datas)
    {
        $envfile = app()->environmentFilePath();
        $str = file_get_contents($envfile);

        if(count($datas)>0){

        }
    }
}
