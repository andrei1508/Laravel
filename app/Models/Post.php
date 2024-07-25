<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    //PHP Intelephense
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'author_id',
        'status_id',
        'title',
        'posts'
    ];
    protected $hidden = [
        'created_at',
        'updated_at', 
        'deleted_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'author_id');
    }
    /*
    protected $appends = [
        'is_latest'
    ]
    
    public function isLatest() {
        return new Attribute (
            get: fn()=>'true'
        )
    }
    public function title() {
        return Attribute::make(
            get: fn($value)=>ucfirst($value),
            set: fn($value)=>strtolower($value)
        )
    }
*/
    

}
