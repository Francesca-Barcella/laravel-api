<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Technology extends Model
{
    use HasFactory;

    /**
     * The roles that belong to the Technology
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    //dentro il model di project definisco la relazione verso Technology
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
