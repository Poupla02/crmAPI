<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
    ];

    public function employe()
    {
        return $this->hasMany(Employe::class, 'entreprise_id');
    }
}
