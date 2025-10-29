<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\User;

class Tarefa extends Model
{
    protected $fillable = [
        'titulo',
        'descricao',
        'concluida',
        'data_limite',
        'categoria_id',
        'created_by',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
