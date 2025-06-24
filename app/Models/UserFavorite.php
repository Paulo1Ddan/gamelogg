<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    protected $table = 'users_favorites';
    public $timestamps = false;
    protected $fillable = ['user_id', 'game_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
