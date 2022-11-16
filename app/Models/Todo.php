<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * Only retrieve active todo items
     *
     * @param Builder $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->whereNull('completed_at');
    }

    /**
     * Complete the current todo item
     *
     * @return void
     */
    public function complete(): void
    {
        $this->completed_at = now();

        $this->save();
    }
}
