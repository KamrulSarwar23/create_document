<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function files(){
        return $this->hasMany(DocumentFile::class);
    }
}
