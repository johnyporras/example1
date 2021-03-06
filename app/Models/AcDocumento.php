<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcDocumento extends Model {

    /**
     * Para usar borrado suave en la base de datos*
     */
    use SoftDeletes;

    /**
     *  Name of database
     * @var string
     */
    protected $table = 'ac_documentos'; 

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_afiliado', 
        'id_tipo_documento',
        'detalle',
        'file',
        'deleted_at'
    ];

    /**
     * Get Tipo Documento.
     */
    public function tipo() {
        return $this->belongsTo(\App\Models\AcTipoDocumento::class, 'id_tipo_documento', 'id');
    }

    /**
     * Get the afiliado
     */
    public function afiliado() {
        return $this->belongsTo(\App\Models\AcAfiliado::class, 'id_afiliado', 'id');
    }

}