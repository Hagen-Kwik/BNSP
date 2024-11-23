<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'id',
        'name',
        'password'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
