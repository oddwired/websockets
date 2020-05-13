<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocketApp extends Model
{
    protected $table = "socket_apps";
    protected $fillable = [
        "name", "key", "secret", "user_id"
    ];

    function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
