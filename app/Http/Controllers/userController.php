<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
class userController extends Controller
{
    //
     //show singl user
     public function showSinglUser(Request $request, $id)
     {
         $user = User::find($id);
 
         return response()->json($user);
     }
     public function update_client(Request $request,$id){
        $validator = Validator::make($request->all(), [
        'nom' => 'required|max:40',
        'prenom' => 'required|max:40',
        'email' => "required|max:40|unique:users,email,$id",
        
        ]);

         if($validator->fails()){
                return response()->json($validator->errors(), 422);
        }

        $user=User::find($id);
        $user->nom=$request->nom;
        $user->prenom=$request->prenom;
        $user->email=$request->email;
     
        $user->save();
    return $user;
    }
    public function update_photo(Request $request,$id){
        $user=User::find($id);
    if(Input::hasFile('photo'))
    {
        $file=Input::file('photo');
        $name = time() . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path().'/uploads/files_client/', $name);
    }
    $user->photo=$name;
    $user->save();
    return $user;
    }


    public function getPassword(Request $request,$id)
{
    $request->validate([
    'passwordAncien' =>'required',

]);

$user=User::find($id);
$hashedPassword = $user->getAuthPassword();

if(!(Hash::check($request->get('passwordAncien'),$hashedPassword))){
  return  response()->json(['false'],500);
}

else {
 return  response()->json(['true'],200);
}

 }

 public function editPassword(request $request,$id ){

    $request->validate([
        'password' =>'required',

    ]);
    $user=User::find($id);
    $user_id = $user->id;

    $changePassword = DB::table('users')

         ->where('id',$user_id)
        ->update(['password' => Hash::make($request->get('password')),
        ]);


     return response()->json(array('success' => true), 200);
}
    
}
