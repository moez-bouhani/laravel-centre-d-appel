<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Poste extends Model
{
    protected $fillable = [
        'num', 'user_id'
    ];
    public  function user(){
        return $this->belongsTo(User::class,'id');
    }
}
