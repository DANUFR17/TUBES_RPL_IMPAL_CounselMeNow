<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Connect;

class Message extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function connect(){
        return $this->belongsTo(Connect::class);
    }
}
