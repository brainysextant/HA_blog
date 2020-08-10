<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Brand;
use App\CarModel;
use App\Car;

use App\Http\Resources\Brand as BrandResource;
use App\Http\Resources\CarModel as CarModelResource;
use App\Http\Resources\Car as CarResource;

class AdminController extends Controller
{

    // BRANDS:

    public function showBrands()
    {
        $brands = Brand::orderBy('name', 'asc')->get(); // En lugar de $brands = Brand::all();
        return view("admin.brands", [
            "brands" => $brands,
        ]);
    }

    public function showBrandCreate()
    {
        return view("admin.brandCreate");
    }

    public function showBrandEdit($id)
    {
        return view("admin.brandEdit", [
            "brand" => Brand::find($id)
        ]);
    }

    public function createBrand(Request $request, Brand $brand)
    {
        $request->validate(Brand::$rules, Brand::$customMessages);
        
        Brand::create($request->all()); // Guarda en la BD.
        
        return redirect('/admin/marcas')->with('mensaje', "La marca $brand->name fue creada exitosamente.");
    }

    public function editBrand(Request $request, Brand $brand)
    {
        $request->validate(Brand::$rules, Brand::$customMessages);

        $brand->update($request->all()); // Guarda en la BD.

        // También se podría haber hecho lo siguiente:
        // $brand->name = $request->name;
        // $brand->save();

        return redirect('/admin/marcas')->with('mensaje', "La marca $brand->name fue actualizada exitosamente.");
    }
    
    public function deleteBrand(Request $request, Brand $brand)
    {
        /**
         * Nota: En un ejercicio real se deberían tomar recaudos adicionales como no permitir
         * que un usuario pueda eliminar entidades que no le corresponden. 
         */
        $brandName = $brand->name; // Se guarda el nombre de la marca, para mostrarlo después.
        $brand->delete();
        return redirect('/admin/marcas')->with('mensaje', "La marca $brandName fue eliminada exitosamente.");
    }

    /*************************************/

    // CAR MODELS:

    public function showModels()
    {
        $models = CarModel::orderBy('name', 'asc')->get(); // En lugar de $models = CarModel::all();
        return view('admin/models', [
            'models' => $models
        ]);
    }

    public function showModelCreate()
    {
        $brands = Brand::orderBy('name', 'asc')->get(); // En lugar de $brands = Brand::all();
        return view('admin/modelCreate', [
            'brands' => $brands
        ]);
    }

    public function showModelEdit($id)
    {  
        $model = CarModel::find($id);
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('admin/modelEdit', [
            'model' => $model,
            'brands' => $brands
        ]);
    }

    public function createCarModel(Request $request, CarModel $carModel)
    {
        $request->validate(CarModel::$rules, CarModel::$customMessages);
        CarModel::create($request->all());
        return redirect('/admin/modelos')->with('mensaje', "El modelo $carModel->name fue creado exitosamente.");
    }

    public function editCarModel(Request $request, CarModel $carModel)
    {
        $request->validate(CarModel::$rules, CarModel::$customMessages);
        $carModel->update($request->all());
        return redirect('/admin/modelos')->with('mensaje', "El modelo $carModel->name fue actualizado exitosamente.");
    }

    public function deleteCarModel(Request $request, CarModel $carModel)
    {
        /**
         * Nota: En un ejercicio real se deberían tomar recaudos adicionales como no permitir
         * que un usuario pueda eliminar entidades que no le corresponden. 
         */
        $carModelName = $carModel->name; // Se guarda el nombre del modelo, para mostrarlo después.
        $carModel->delete();
        return redirect('/admin/modelos')->with('mensaje', "El modelo $carModelName fue eliminado exitosamente.");
    }

    /*************************************/

    // CARS:

    public function showCars()
    {
        $cars = Car::all();
        return view("admin.cars", [
            "cars" => $cars,
        ]);
    }

    public function showCarCreate()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        $models = CarModel::orderBy('name', 'asc')->get();
        return view('admin.carCreate', compact('brands', 'models'));
    }

    public function showCarEdit($id)
    {  
        $car = Car::find($id);
        $brands = Brand::orderBy('name', 'asc')->get();
        $models = CarModel::orderBy('name', 'asc')->get();
        return view('admin.carEdit', compact('car', 'brands', 'models'));
    }

    public function createCar(Request $request)
    {
        Car::validate($request->all()); // El método 'validate' se definió en la clase Car.

        $car = Car::create($request->all());
        
        $car->image = $request->file('image')->store('cars');
        
        $car->save(); // Guarda en la BD.
        
        return redirect('/admin/autos')->with('mensaje', "El auto " . $car->brand->name . " " . $car->car_model->name . " fue creado exitosamente.");
    }

    public function editCar(Request $request, Car $car)
    {
        $previousImage = $car->image; // Se guarda la ruta a la imagen (previa) del auto.
        
        Car::validate($request->all()); // El método 'validate' se definió en la clase Car.

        $car->update($request->all());

        if($request->hasFile('image')) {
            Storage::delete($previousImage);
            $car->image = $request->file('image')->store('cars');
            $car->save();
        }

        return redirect('/admin/autos')->with('mensaje', "El auto " . $car->brand->name . " " . $car->car_model->name . " fue actualizado exitosamente.");
    }
    
    public function deleteCar(Request $request, Car $car)
    {
        /**
         * Nota: En un ejercicio real se deberían tomar recaudos adicionales como no permitir
         * que un usuario pueda eliminar entidades que no le corresponden. 
         */
        $brandName = $car->brand->name; // Se guarda el nombre de la marca, para mostrarlo después.
        $modelName = $car->car_model->name;// Se guarda el nombre del modelo, para mostrarlo después.
        Storage::delete($car->image);
        $car->delete();
        return redirect('/admin/autos')->with('mensaje', "El auto " . $brandName . " " . $modelName . " fue eliminado exitosamente.");
    }
}
