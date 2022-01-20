<?php

namespace TaskApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Imanghafoori\Tags\Traits\hasTempTags;
use TaskApp\Database\Factory\TaskFactory;

class Task extends Model
{
    use HasFactory;
    use hasTempTags;

    protected static function newFactory()
    {
        return TaskFactory::new();
    }

    protected $fillable = [
        'user_id',
        'name',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
