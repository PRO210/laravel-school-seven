<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['ACAO', 'ACAO_DETALHES', 'aluno_id', 'user_id'];
}
