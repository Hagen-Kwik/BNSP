<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
