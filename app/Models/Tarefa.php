<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Tarefa extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'concluida',
        'data_limite',
        'categoria_id',
        'created_by',
        'arquivo', 
    ];

    /**
     * Relação: cada tarefa pertence a uma categoria
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Relação: criador da tarefa (usuário)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Acessor para retornar a URL pública do arquivo, se existir
     */
    public function getArquivoUrlAttribute()
    {
        return $this->arquivo ? Storage::url($this->arquivo) : null;
    }
}
