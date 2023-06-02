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
        'doc_nom_id',
        'file_path',
        'is_deleted',
    ];

    
    public function Candidat()
    {
        return $this->belongsTo(Candidat::class,'candidat_id','id');
    }
    public function Doc_nom()
    {
        return $this->belongsTo(Doc_nom::class,'doc_nom_id','id');
    }
}
