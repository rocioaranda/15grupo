<?php

namespace App\Traits;

trait Filterable
{
    public function scopeFiltrar($query, $request)
    {
        return $query
            ->when($request->filled('id'), function ($q) use ($request) {
                $q->where('id', $request->id);
            })
            ->when($request->filled('nombre'), function ($q) use ($request) {
                $q->where('nombre', 'like', "%{$request->nombre}%");
            })
            ->when($request->filled('categoria_id'), function ($q) use ($request) {
                $q->where('categoria_id', $request->categoria_id);
            });
    }
}