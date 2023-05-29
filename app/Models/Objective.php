<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;
    public function candidats()
    {
        return $this->hasMany(Candidat::class,"objective_id", "id");
    }
}
