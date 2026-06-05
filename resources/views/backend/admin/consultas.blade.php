@extends('layouts.app')

@section('main')
<div class="container py-4">
    <h4 class="fw-bold text-success mb-4">Gestión de Consultas</h4>

    @if(session('exito'))
        <div class="alert alert-success">{{ session('exito') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-dark table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Asunto</th>
                    <th>Mensaje</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultas as $consulta)
                <tr>
                    <td>{{ $consulta->id }}</td>
                    <td>{{ $consulta->nombre }}</td>
                    <td>{{ $consulta->email }}</td>
                    <td>{{ $consulta->asunto }}</td>
                    <td>{{ $consulta->mensaje }}</td>
                    <td>
                        @if($consulta->estado == 'pendiente')
                            <span class="badge bg-warning">Pendiente</span>
                        @elseif($consulta->estado == 'vista')
                            <span class="badge bg-info">Vista</span>
                        @else
                            <span class="badge bg-success">Respondida</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.consultas.estado', $consulta->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="estado" class="form-select form-select-sm bg-dark text-white border-secondary mb-1">
                                <option value="pendiente" {{ $consulta->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="vista" {{ $consulta->estado == 'vista' ? 'selected' : '' }}>Vista</option>
                                <option value="respondida" {{ $consulta->estado == 'respondida' ? 'selected' : '' }}>Respondida</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-outline-success w-100">Guardar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection