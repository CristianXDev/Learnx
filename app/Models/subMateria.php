<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submateria extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'submaterias';

    protected $fillable = ['nombre','materia_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examenes(){
        
        return $this->hasMany('App\Models\Examene', 'submateria_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function materia()
    {
        return $this->hasOne('App\Models\Materia', 'id', 'materia_id');
    }
    
}
