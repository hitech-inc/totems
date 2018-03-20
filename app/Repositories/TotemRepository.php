<?php

namespace App\Repositories;

use App\Models\Totem;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TotemRepository
 * @package App\Repositories
 * @version January 28, 2018, 6:39 am UTC
 *
 * @method Totem findWithoutFail($id, $columns = ['*'])
 * @method Totem find($id, $columns = ['*'])
 * @method Totem first($columns = ['*'])
*/
class TotemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'status',
        'ip_addr'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Totem::class;
    }
}
