<?php

namespace App\Repositories;

use App\Models\Eventos;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EventosRepository
 * @package App\Repositories
 * @version September 13, 2017, 8:33 pm VET
 *
 * @method Eventos findWithoutFail($id, $columns = ['*'])
 * @method Eventos find($id, $columns = ['*'])
 * @method Eventos first($columns = ['*'])
*/
class EventosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'titulo',
        'fechainicio',
        'fechafin',
        'hora'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Eventos::class;
    }
}
