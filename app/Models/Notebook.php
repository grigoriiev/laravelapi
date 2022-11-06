<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    use HasFactory;

  /*  protected $fillable = ['fio',
    'tel',
    'email',
    'company',
    'date',
    'foto'];*/

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];



}
