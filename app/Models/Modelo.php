<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'nome',
        'imagem',
        'numero_portas',
        'lugares',
        'air_bag',
        'abs',
    ];

    public function rules()
    {
        return [
            'marca_id' => 'exists:marcas,id',
            'nome' => 'required|string|unique:modelos,nome,' . $this->id . '|min:3',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'numero_portas' => 'required|integer|digits_between:1,5',
            'lugares' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean',
        ];
    }


    //RELACIONAMENTO DE TABELAS
    public function marca()
    {
        //UM MODELO PERTENCE A UMA MARCA
        return $this->belongsTo(Marca::class);
    }

    public function carro()
    {
        //UM MODELO TEM MUITOS CARROS
        return $this->hasMany(Marca::class);
    }
}
