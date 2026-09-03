<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'       => ['required', 'string', 'max:150'],
            'descripcion'  => ['required', 'string'],
            'precio'       => ['required', 'numeric', 'min:0'],
            'stock'        => ['required', 'integer', 'min:0'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'activo'       => ['nullable', 'boolean'],
            'imagen'       => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'], // nullable: no siempre se cambia la foto
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'       => 'El nombre del producto es obligatorio.',
            'nombre.string'         => 'El nombre debe ser un texto válido.',
            'nombre.max'            => 'El nombre no puede superar los 150 caracteres.',

            'descripcion.required'  => 'La descripción del producto es obligatoria.',
            'descripcion.string'    => 'La descripción debe ser un texto válido.',

            'precio.required'       => 'El precio es obligatorio.',
            'precio.numeric'        => 'El precio debe ser un número válido.',
            'precio.min'            => 'El precio no puede ser negativo.',

            'stock.required'        => 'El stock es obligatorio.',
            'stock.integer'         => 'El stock debe ser un número entero.',
            'stock.min'             => 'El stock no puede ser negativo.',

            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists'   => 'La categoría seleccionada no es válida.',

            'activo.boolean'        => 'El campo activo debe ser verdadero o falso.',

            'imagen.image'          => 'El archivo debe ser una imagen válida.',
            'imagen.mimes'          => 'La imagen debe ser de tipo: jpeg, jpg, png o webp.',
            'imagen.max'            => 'La imagen no puede superar los 5 MB.',
        ];
    }
}