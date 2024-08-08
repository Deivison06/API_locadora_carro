<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
        'nome',
    ];

    public function rules()
    {
        return [
            'nome' => 'required|string|min:3',
        ];
    }

    //RELACIONAMENTO DE TABELAS
    public function locaçoes()
    {
        //UM CLIENTE POSSUI MUITAS LOCAÇÕES
        return $this->hasMany(Locacao::class);
    }
}
