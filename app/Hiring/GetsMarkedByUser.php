<?php


namespace App\Hiring;


use App\User;

trait GetsMarkedByUser
{
    public function user()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }

    public function userName()
    {
        return $this->user ? $this->user->name : '';
    }
}