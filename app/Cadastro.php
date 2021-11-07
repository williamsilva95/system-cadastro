<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadastro extends Model
{
    protected $table = 'cadastro';

    protected $fillable = ['email', 'file', 'message', 'name', 'telephone'];

    public function rules() {

        return [

            'email'  => 'required',
            'file'=>'required|file|max:500',
            'message' => 'required',
            'name' => 'required',
            'telephone' => 'required',


        ];
    }

    public $mensages = [

        'email.required' => 'Email não informado.',
        'file.required' => 'Arquivo não identificado.',
        'message.required' => 'Mensagem é obrigatório.',
        'name.required' => 'Nome é obrigatório.',
        'telephone.required' => 'Telefone é obrigatório.',

    ];
}
