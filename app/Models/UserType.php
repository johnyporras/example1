<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model {

    use SoftDeletes;
    /**
     * Generated
     */

    protected $table = 'user_types';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['id', 'name', 'modules', 'active', 'deleted_at'];

    /**
     * Get the Users for Type User.
     */
    public function users()
    {
        return $this->hasMany(\App\User::class,'type','id');
    }

}
