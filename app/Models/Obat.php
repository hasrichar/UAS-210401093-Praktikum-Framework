<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'penyakit_id'];

    public function penyakit(){
        return $this->belongsTo(Penyakit::class);
    }
    

}
