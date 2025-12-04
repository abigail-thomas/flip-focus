<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    protected $fillable = ['term', 'definition', 'study_set_id'];

    /** @use HasFactory<\Database\Factories\FlashcardFactory> */
    use HasFactory;

    public function studySet() {
        return $this->belongsTo(StudySet::class);
    }

    
}
