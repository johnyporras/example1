<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submodule extends Model {

    use SoftDeletes;
    /**
     * Generated
     */
    protected $table = 'submodules';

    protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'description', 'modules_id', 'url', 'url2', 'url3', 'url4', 'url5', 'order', 'deleted_at'];

    public function module()
    {
        return $this->belongsTo(\App\Models\Module::class, 'modules_id', 'id');
    }
}
