<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Totem
 * @package App\Models
 * @version January 28, 2018, 6:39 am UTC
 *
 * @property string name
 * @property string status
 * @property string ip_addr
 */
class Totem extends Model
{
    use SoftDeletes;

    public $table = 'totems';
    

    protected $dates = ['deleted_at', 'last_seen_at'];


    public $fillable = [
        'name',
        'status',
        'ip_addr'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'status' => 'string',
        'ip_addr' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    
}
