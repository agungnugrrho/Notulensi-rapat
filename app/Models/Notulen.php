<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class Notulen extends Model
{
    use HasFactory;
    protected $table = 'notulens';
    protected $fillable = ['dateInput','timeInput','place','chairman','notulen','agenda','pembahasan','keputusan','keterangan','slug'];
    // protected $fillable = ['dateInput','place','chairman','notulen','agenda','pembahasan','keputusan','keterangan'];
    protected $dates =['dateInput'];
}

