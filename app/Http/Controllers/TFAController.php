<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Nexmo\Laravel\Facade\Nexmo;

class TFAController extends Controller
{
    public function get2FA()
    {
        if (session('2FAPASSED')) {
            return redirect('/dashboard');
        }
        $num = random_int(100000, 999999);
        Cache::put(auth()->user()->fileNo . "2FA", $num, 60 * 5);
        /* $basic = new Basic('c8913f6d', 'xCO2G9Li4qZamF8l');
        $client = new \Nexmo\Client($basic);
        $message = [
            'from' => 'KADPOLY RPS',
            'to' => '+2347032699916',
            'text' => "Dear " . auth()->user()->fullnname . ", Your 2FA result processing system code is '" . $num . "' .This will expire in 5 minutes"
        ];*/
        //dd($message);
        // $client->message()->send($message);
        Nexmo::message()->send([
            'to'   => '+2347032699916',
            'from' => 'KADPOLY RPS',
            'text' => "Dear " . auth()->user()->fullnname . ", Your 2FA result processing system code is '" . $num . "' .This will expire in 5 minutes"
        ]);
        return view('auth.2FA');
    }
    public function submit2FA()
    {
        $code = request('2FACODE');
        if (Cache(auth()->user()->fileNo . "2FA") == $code) {
            session()->put('2FAPASSED', True);
            return redirect('/');
        }
        return redirect('/2FA');
    }
}