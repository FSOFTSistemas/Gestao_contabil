<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'precocusto',
        'precovenda',
        'estoque',
        'empresa_id',
    ];


    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
