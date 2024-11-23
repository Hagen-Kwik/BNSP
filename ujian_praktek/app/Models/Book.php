<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'id',
        'author',
        'member_id',
        'title',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
