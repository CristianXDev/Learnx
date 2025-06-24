<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'likes';

    protected $fillable = ['like','dislike','estudiante_id','video_id'];
	
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
        return $this->hasOne('App\Models\VideosCurso', 'id', 'video_id');
    }
    
}
