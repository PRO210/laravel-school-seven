<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunoSolicitacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_solicitacao', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('turma_id')->unsigned();
            $table->bigInteger('aluno_id')->unsigned();
            $table->bigInteger('classificacao_id')->unsigned();

            $table->string('SOLICITANTE')->nullable();;
            $table->date('DATA_SOLICITACAO');
            $table->string('TRANSFERENCIA_STATUS');
            $table->date('DATA_TRANSFERENCIA_STATUS')->nullable();
            $table->string('DECLARACAO')->nullable();
            $table->string('RESPONSAVEL_DECLARACAO')->nullable();
            $table->date('DATA_DECLARACAO')->nullable();
            $table->string('TRANSFERENCIA')->nullable();
            $table->string('RESPONSAVEL_TRANSFERENCIA')->nullable();
            $table->date('DATA_TRANSFERENCIA')->nullable();
            $table->string('T1')->nullable();
            $table->string('T2')->nullable();
            $table->string('T3')->nullable();
            $table->string('T4')->nullable();
            $table->string('T5')->nullable();
            $table->string('T6')->nullable();
            $table->string('T7')->nullable();
            $table->string('OBS')->nullable();

            $table->timestamps();

            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
            $table->foreign('classificacao_id')->references('id')->on('classificacaos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aluno_solicitacao');
    }
}
