<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Books extends Model
{
    use HasFactory, softDeletes;
    // public $timestamps = false;
    protected $fillable = ['book_title', 'book_description', 'book_auther', 'book_image', 'authers_id'];
    // protected $guarded = ['authers_id'];
    public function auther()
    {
        // dd($this);
        return $this->belongsTo(Authers::class, 'authers_id');
    }
}