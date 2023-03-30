<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Numero;
use App\User;

class NumeroController extends Controller
{
    public function index()
    {
        $numeros=Numero::get();
        return response()->json(['numeros' =>$numeros], 200);
    }


    //save multiple numeros at once
    public function store(Request $request)
    {
    $numero=[];
        if($request->numero)
        {
        $data = $this->validate($request, [
            'numero' => 'required|array',
            'numero.*.id' => 'integer',
          ]);
        foreach ($data['numero'] as $num) {
            $numero[]= array(
                'nom' => $num['nom'],
                'prenom' => $num['prenom'],
                'adresse' => $num['adresse'],
                'telephone' => $num['telephone'],
                'code_postale' => $num['code_postale'],
                'date_nais' => $num['date_nais'],
                'user_id' => $num['user_id'],
                'statut'=>0
                );
        }
        Numero::insert($numero);
        return response()->json(['numero'=>$numero]);
    }
    }
    public function show($id)
    {
        $Numero=Numero::find($id)->get();
        return response()->json(['succes' => $Numero], 200);

    }
    public function showAllEmp()
    {
        $users=User::with('numero_post')->where('role',1)->get();
        return response()->json(['succes' => $users], 200);

    }
    public function showEmpById($id)
    {
        $users=User::with('numero_post','numero_list')->where('role',1)->where('id',$id)->get();
        return response()->json(['succes' => $users], 200);

    }

    public function numerosByUserid($id)
    {
        $numerosUser=User::with('numero_list')->where('id',$id)->get();
        return response()->json(['numerosUser' => $numerosUser], 200);

    }


    public function update(Request $request, $id)
    {
        $chnageNumero=Numero::where('id',$id)->update([

            'nom'=>$request['nom'],
            'prenom'=>$request['prenom'],
            'adresse'=>$request['adresse'],

            'telephone'=>$request['telephone'],
            'code_postale'=>$request['code_postale'],
            'date_nais'=>$request['date_nais'],


           // 'statut'=>$request['code_postale'] // Not yet copied ( 1 ==> progress the copie ) (2 ==> finsh the copie)

        ]);
        return response()->json(['succes' => $chnageNumero], 200);

    }
    public function updatestatut(Request $request, $id)
    {
        $chnageNumero=Numero::where('id',$id)->update([

         'statut'=>1// Not yet copied ( 1 ==> progress the copie ) (2 ==> finsh the copie)

        ]);
        return response()->json(['succes' => $chnageNumero], 200);

    }


    public function destroy($id)
    {
        $delete = Numero::find($id);

               if (!$delete) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, delete with id ' . $id . ' cannot be found'
                ], 400);
            }

            if ($delete->delete()) {
                return response()->json([
                    'success' => true ,
                    'message' => 'delete with id ' . $id . ' is deleted ',
                    'delete' => $delete
                    ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'delete could not be deleted'
                ], 500);
            }

    }

}
