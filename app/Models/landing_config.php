<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class landing_config extends Model
{
    protected $table = 'landingpage';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $keytype = 'string';

    protected $fillable = [
        'value','name'
    ];
}
