<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudySet extends Model
{
    /** @use HasFactory<\Database\Factories\StudySetFactory> */
    use HasFactory;

    protected $fillable = ['title', 'subject', 'description', 'user_id', 'author', 'num_studies'];

    public function flashcards() {
        return $this->hasMany(Flashcard::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function savedByUsers() {
        return $this->belongsToMany(User::class, 'saved_study_set');
    }

}
