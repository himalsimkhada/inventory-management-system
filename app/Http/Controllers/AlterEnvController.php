<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlterEnvController extends Controller
{

    public function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $str .= "\n"; // In case the searched variable is in the last line without \n
        $keyPosition = strpos($str, "{$envKey}=");
        $endOfLinePosition = strpos($str, PHP_EOL, $keyPosition);
        $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
        $str = substr($str, 0, -1);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
    public function caller(Request $request)
    {
        $data = $request->all();

        if ($request->isMethod('post')) {

            $this->setEnvironmentValue('MAIL_USERNAME', $data['mail_username']);
            $this->setEnvironmentValue('MAIL_PORT', $data['mail_port']);
            $this->setEnvironmentValue('MAIL_PASSWORD', $data['mail_password']);
            $this->setEnvironmentValue('MAIL_ENCRYPTION', $data['mail_encryption']);
            $this->setEnvironmentValue('MAIL_HOST', $data['mail_host']);
            return redirect()->back();
        } else {
            return view('admin.mailSetting');
        }
    }
}
