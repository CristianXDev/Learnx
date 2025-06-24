<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideosCompletado extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'videos_completados';

    protected $fillable = ['estudiante_id','videos_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'estudiante_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function videosCurso()
    {
        return $this->hasOne('App\Models\VideosCurso', 'id', 'videos_id');
    }
    
}
