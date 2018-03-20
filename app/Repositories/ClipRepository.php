<?php

namespace App\Repositories;

use App\Models\Clip;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ClipRepository
 * @package App\Repositories
 * @version January 30, 2018, 9:49 am +06
 *
 * @method Clip findWithoutFail($id, $columns = ['*'])
 * @method Clip find($id, $columns = ['*'])
 * @method Clip first($columns = ['*'])
*/
class ClipRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'path'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Clip::class;
    }
}
