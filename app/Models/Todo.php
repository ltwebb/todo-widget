<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'task',
        'time',
        'created_at',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($todo) {
            $todo->user_id = Auth::id();
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
