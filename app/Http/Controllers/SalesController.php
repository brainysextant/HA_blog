<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Brand;
use App\CarModel;

class SalesController extends Controller
{
    public function filterCars(Request $request)
    {
        $brands = Brand::all();
        $models = CarModel::all();

        /**
         * Se crea un array que sólo contiene los campos que fueron usados en el filtro.
         * Por ejemplo, si el usuario sólo seleccionó año y marca, el siguiente array
         * tendrá un formato como: $fields = ['year' => 2018, 'brand_id' => 1]
         * En caso de que el usuario no haya utilizado el filtro, el array estará vacío.
         */ 
        $fields = array_filter($request->all(), function($field) {
            return ($field !== null && $field !== false && $field !== ''); 
        });

        $cars = Car::filter($fields);

        return view('sales', [
            'status'    => $request->status,
            'brands'    => $brands,
            'models'    => $models,
            'cars'      => $cars
        ]);
    }
}
