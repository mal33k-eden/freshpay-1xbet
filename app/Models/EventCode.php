<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCode extends Model
{
    use HasFactory;

    private  $fillable = [
      'code','description'
    ];


}
