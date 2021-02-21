<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Router extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $datas = ['created_at', 'updated_at'];

    protected $dates = [
      'created_at' => 'Y-m-d h:i:s'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sap_id',
        'hostname',
        'loopback',
        'mac_address'
    ];

}
