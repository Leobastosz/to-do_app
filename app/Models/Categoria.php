<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Categoria extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'created_by',
    ];

    public function creator(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tarefas(){
        return $this->hasMany(Tarefa::class);
        }

}