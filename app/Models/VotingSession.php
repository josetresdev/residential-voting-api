<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VotingSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'voting_sessions';

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'status',
    ];

    protected $casts = [
        'uuid' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
