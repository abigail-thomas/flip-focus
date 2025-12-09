<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedStudySet extends Model
{
    //
    
    public function savedByUsers() {
        return $this->belongsToMany(User::class, 'saved_study_set', 'user_id', 'study_set_id');
    }
}
