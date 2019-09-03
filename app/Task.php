<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['caption','description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUpdatedDate()
    {
        return $this->updated_at->diffForHumans();
    }

    public function doesntBelongToUserAndNotPublished()
    {
        return (auth()->user()->id !== $this->user->id && !$this->isPublished && $this->user->hasRole('Author'));
    }
}
