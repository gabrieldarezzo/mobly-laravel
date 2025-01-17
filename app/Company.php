<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $table = 'company';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'catchPhrase',
        'bs',
    ];
}
