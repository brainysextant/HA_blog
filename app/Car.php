<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Rules\ModelInBrand;

class Car extends Model
{

    // Docs: https://laravel.com/docs/master/eloquent#mass-assignment
    protected $fillable = [
        "brand_id",
        "car_model_id",
        "description",
        "image",
        "year",
        "price_usd",
        "rating",
        "status",
    ];

    // Docs: https://laravel.com/docs/master/eloquent-relationships#one-to-many-inverse
    public function brand()
    {
        return $this->belongsTo("App\Brand");
    }

    // Docs: https://laravel.com/docs/master/eloquent-relationships#one-to-many-inverse
    public function car_model()
    {
        return $this->belongsTo("App\CarModel");
    }

    // Docs: https://laravel.com/docs/master/validation
    public static function validate($fields) {
        Validator::make($fields, [
            'brand_id'      => 'required|exists:brands,id',
            'car_model_id'  => ['required', 'exists:car_models,id', new ModelInBrand($fields['brand_id'])],
            'year'          => 'required|integer',
            'price_usd'     => 'required|integer',
            'description'   => 'required',
            'status'        => 'required|integer',
            'rating'        => 'required|integer',
            'image'         => 'required_without:image_actual|image',
        ],
        [
            'brand_id.required'         => 'El campo Marca es obligatorio.',
            'brand_id.exists'           => 'La marca seleccionada no existe.',
            'car_model_id.required'     => 'El campo Modelo es obligatorio.',
            'car_model_id.exists'       => 'El modelo seleccionado no existe.',
            'year.required'             => 'El campo Año es obligatorio.',
            'price_usd.required'        => 'El campo Precio es obligatorio.',
            'description.required'      => 'El campo Descripción es obligatorio.',
            'status.required'           => 'El campo Estado es obligatorio.',
            'rating.required'           => 'El campo Rating es obligatorio.',
            'image.required_without'    => 'El campo Imagen es obligatorio.',
            'image.image'               => 'El campo Imagen debe ser un archivo .jpg, .png o .gif.',
        ]
        )->validate();
    }

    public static function filter($fields) {
        return Car::where($fields)->get();
    }
    
}
