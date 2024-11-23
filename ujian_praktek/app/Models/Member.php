<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
