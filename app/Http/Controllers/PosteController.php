<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Numero;
class PosteController extends Controller
{
    public function store(Request $request)
    {
        $Numero= Numero::create([
            'user_id'=>$request['user_id'],
            'num'=>$request['num']  
        ]);
            return response()->json(['Numero'=>$Numero]);
    }
}
