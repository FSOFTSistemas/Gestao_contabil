<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',            // Nome do cliente
        'email',           // Email do cliente
        'telefone',        // Telefone do cliente
        'endereco',        // Endereço do cliente
        'cidade',          // Cidade do cliente
        'estado',          // Estado do cliente
        'empresa_id',      // Relacionamento com empresa
    ];

    /**
     * Relacionamento: O Cliente pertence a uma Empresa.
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
