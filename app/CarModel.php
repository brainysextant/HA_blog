<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{

    // Docs: https://laravel.com/docs/master/eloquent#mass-assignment
    protected $fillable = ['name', 'brand_id'];

    // Docs: https://laravel.com/docs/master/eloquent-relationships#one-to-many-inverse
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
    
    // Docs: https://laravel.com/docs/master/eloquent-relationships#one-to-many
    public function cars()
    {
        return $this->hasMany("App\Car");
    }

    // Docs: https://laravel.com/docs/master/validation
    public static $rules = [
        'name'          => 'required|min:2',
        'brand_id'      => 'required',
    ];

    // Docs: https://laravel.com/docs/master/validation
    public static $customMessages = [
        'name.required'         => 'El campo nombre es obligatorio.',
        'name.min'              => 'El campo nombre debe tener al menos 2 caracteres.',
        'brand_id.required'     => 'El campo marca es obligatorio.',
    ];
}
