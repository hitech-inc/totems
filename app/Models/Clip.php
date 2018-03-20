<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Clip
 * @package App\Models
 * @version January 30, 2018, 9:49 am +06
 *
 * @property string name
 * @property string path
 */
class Clip extends Model
{
    use SoftDeletes;

    public $table = 'clips';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'path',
        'mime'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'path' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
