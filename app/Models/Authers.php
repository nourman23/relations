<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authers extends Model
{
    use HasFactory;
    public function books()
    {
        // dd($this);
        return $this->hasMany(Books::class);
    }
}