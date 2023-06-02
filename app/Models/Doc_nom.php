<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc_nom extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_ar',
        'nom_fr',
        'code',
        'groupe',
    ];

    public function candidats()
    {
        return $this->hasMany(Document::class,"doc_nom_id", "id");
    }
}
