<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\CarModel;

class ModelInBrand implements Rule
{

    private $brand_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $carModel = CarModel::find($value);
        return ($carModel->brand->id == $this->brand_id); // No usar "igual estricto".
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El modelo seleccionado no pertenece a la marca seleccionada.';
    }
}
