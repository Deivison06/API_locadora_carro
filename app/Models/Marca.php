<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem',
    ];

    public function rules()
    {
        return [
            'nome' =>'required|string|unique:marcas,nome,'.$this->id.'|min:3',
            'imagem' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    //RELACIONAMENTO DE TABELAS
    public function modelos()
    {
        //UMA MARCA POSSUI MUITOS MODELOS
        return $this->hasMany(Modelo::class);
    }
}
