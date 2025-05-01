<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'votes';

    protected $fillable = [
        'uuid',
        'user_id',
        'voting_session_id', // Corregido aquí
        'option_id',
    ];

    protected $casts = [
        'uuid' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votingSession()
    {
        return $this->belongsTo(VotingSession::class); // Corregido aquí
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
