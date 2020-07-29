<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
   /*  protected $table = 'aluno_solicitacao'; */

    protected $fillable = ['NOME', 'TIPO', 'ORDEM'];
}
