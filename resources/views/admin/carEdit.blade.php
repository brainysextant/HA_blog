@extends('layouts.master')

@section('content')

    <div id="admin-edit" class="container mt-4" style="max-width:600px;">

        @include('admin.message')
        @include('admin.errors')

        <h1>Editar Auto</h1>

        <form action="{{ url('/admin/autos/' . $car->id . '/editar') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label for="select-brand">Marca</label>
                <select id="select-brand" class="form-control input-sm" name="brand_id">
                    <option value="">Seleccionar...</option>
                    @foreach ($brands as $brand)
                        @if ($car->brand->id == $brand->id || old('brand_id') == $brand->id)
                            <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                        @else
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="select-model">Model</label>
                <select id="select-model" class="form-control input-sm" name="car_model_id">
                    <option value="">Seleccionar...</option>
                    @foreach ($models as $model)
                        @if ($car->car_model->id == $model->id || old('car_model_id') == $model->id)
                            <option value="{{ $model->id }}" selected>{{ $model->name }}</option>
                        @else
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="year">Año</label>
                <input type="tel" class="form-control" id="year" name="year" placeholder="Ingresar año..." value="{{ old('year', $car->year) }}" maxlength="4">
            </div>

            <div class="form-group">
                <label for="price_usd">Precio (USD)</label>
                <input type="tel" class="form-control" id="price_usd" name="price_usd" placeholder="Ingresar precio..." value="{{ old('price_usd', $car->price_usd) }}">
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="content" name="description" rows="6">{{ old('description', $car->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">¿Nuevo (1) o Usado (0)?</label>
                <input type="tel" class="form-control" id="status" name="status" placeholder="Ingresar 1 ó 0..." value="{{ old('status', $car->status) }}" maxlength="1">
            </div>

            <div class="form-group">
                <label for="rating">Rating</label>
                <input type="tel" class="form-control" id="rating" name="rating" placeholder="Ingresar rating (1 a 5)..." value="{{ old('rating', $car->rating) }}" maxlength="1">
            </div>

            <div class="form-group">
                <label for="image">Imagen</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <input type="hidden" name="image_actual" value="{{ $car->image }}">

            <button type="submit" class="btn btn-primary">Editar</button>

        </form>

    </div><!-- /.container -->

@endsection
