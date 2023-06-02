<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'fonction',
        'grade_id',
        'pays_id',
        'pays_nom',
        'objective_id',
        'etablissement',
        'year_of_last_benefit',

        'document',
        'etat',
        'remaque',
        'is_deleted'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class,"grade_id","id");
    }
    public function pays()
    {
        return $this->belongsTo(Pays::class,"pays_id","id");
    }
    public function objective()
    {
        return $this->belongsTo(Objective::class,"objective_id","id");
    }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }

    
    public function document()
    {
        return $this->hasMany(document::class,'candidat_id','id');
    }
}
