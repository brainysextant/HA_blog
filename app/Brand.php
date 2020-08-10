<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    // Docs: https://laravel.com/docs/master/eloquent#mass-assignment
    protected $fillable = ['name']; 

    // Docs: https://laravel.com/docs/master/validation
    public static $rules = [
        'name' => 'required|min:2',
    ];

    // Docs: https://laravel.com/docs/master/validation
    public static $customMessages = [
        'name.required' => 'El campo nombre es obligatorio.',
        'name.min' => 'El campo nombre debe tener al menos 2 caracteres.'
    ];

    // Docs: https://laravel.com/docs/master/eloquent-relationships#one-to-many
    public function car_models()
    {
        return $this->hasMany('App\CarModel');
    }

    // Docs: https://laravel.com/docs/master/eloquent-relationships#one-to-many
    public function cars()
    {
        return $this->hasMany("App\Car");
    }

}
