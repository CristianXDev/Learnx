<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeminiChat extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'gemini_chat';

    protected $fillable = ['usuario_id','pregunta','respuesta'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }
    
}
