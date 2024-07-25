<?php

namespace App\Models

class Comment extends Model {
    protected $fillable = [
        'author_id'
        'comment'
    ]

    protected $hidden = [
        'created_at',
        'updated_at', 
        'deleted_at'
    ];
}