<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poste;
class PosteController extends Controller
{
    public function store(Request $request)
    {
        $Numero= Poste::create([
            'user_id'=>$request['user_id'],
             'num'=>$request['num']  
        ]);
            return response()->json(['Numero'=>$Numero]);
    }
}
