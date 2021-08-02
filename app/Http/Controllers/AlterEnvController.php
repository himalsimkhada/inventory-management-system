<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlterEnvController extends Controller
{

    public function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = strtok($str, "{$envKey}=");

        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}\n", $str);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
    public function caller(Request $request)
    {
        $data = $request->all();

        if ($request->isMethod('post')) {
           
            $this->setEnvironmentValue('MAIL_USERNAME', $data['mail_username']);
            // dd($data['mail_username']);
            return redirect()->back();
        } else {
            return view('admin.mailSetting');
        }
    }
}
