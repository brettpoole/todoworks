<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'completed_at', 'user_id',
    ];

    /**
     * User for this Todo item
     *
     * @return Relation
     */
    public function user(): Relation
    {
        return $this->belongsTo(User::class);
    }
}
