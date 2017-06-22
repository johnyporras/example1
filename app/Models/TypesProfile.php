<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypesProfile extends Model 
{
    /**
     * Generated
     */
    protected $table = 'types_profile';
    
    protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'id_type', 'id_module', 'deleted_at'];


    public function userType()
    {
        return $this->belongsTo(\App\Models\UserType::class, 'id_type', 'id');
    }

    public function submodule()
    {
        return $this->belongsTo(\App\Models\Submodule::class, 'id_module', 'id');
    }

    public function incluir()
    {
        try 
        {
            if($this->save())
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch ( \Exception $e)
        {
             echo $e->getMessage();
            return false;
        }
    }



    public function tienePermiso()
    {

        $results=$this->select("id")
                ->where("id_module","=",$this->id_module)
                ->where("id_type","=",$this->id_type)->get();
//dd()
        if($results->count()>0)
        {
            //dd("aqui");
            return true;
        }
        else
        {
            return false;
        }
    }


    public function checkPermiso()
    {

        $results=$this->select("types_profile.id")
                ->join("submodules","types_profile.id_module","=","submodules.id")
                ->whereRaw("('{$this->url}' like '%'||url or '{$this->url}' like '%'||url2 or '{$this->url}' like '%'||url3 or '{$this->url}' like '%'||url4)")
                ->where("id_type","=",$this->id_type)->get();
                //echo $results->count();die();
               // dd($results);
        if($results->count()>0)
        {
            //dd("aqui");
            return true;
        }
        else
        {
            return false;
        }
    }
}
