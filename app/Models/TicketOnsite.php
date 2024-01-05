<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketOnsite extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function connect(){
        return $this->belongsTo(Connect::class);
    }
}
