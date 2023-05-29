<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidat_id',
        'nom',
        'file_path'
    ];

    
    public function Candidat()
    {
        return $this->belongsTo(Candidat::class,'candidat_id','id');
    }
}
