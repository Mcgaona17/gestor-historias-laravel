@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0">Editar Historia de Usuario</h2>
                <a href="{{ route('board') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left"></i> Volver al Tablero
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form action="{{ route('historias.update', $historia->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="titulo" class="form-label">Título*</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" 
                            value="{{ old('titulo', $historia->titulo) }}" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="puntos" class="form-label">Puntos de Complejidad (1-10)*</label>
                        <input type="number" class="form-control" id="puntos" name="puntos" 
                            value="{{ old('puntos', $historia->puntos) }}" min="1" max="10" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción*</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $historia->descripcion) }}</textarea>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="estado" class="form-label">Estado*</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="nueva" {{ $historia->estado == 'nueva' ? 'selected' : '' }}>Nueva</option>
                            <option value="activa" {{ $historia->estado == 'activa' ? 'selected' : '' }}>Activa</option>
                            <option value="finalizada" {{ $historia->estado == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                            <option value="impedimento" {{ $historia->estado == 'impedimento' ? 'selected' : '' }}>Impedimento</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="fecha_creacion" class="form-label">Fecha Creación*</label>
                        <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" 
                            value="{{ old('fecha_creacion', $historia->fecha_creacion->format('Y-m-d')) }}" required>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="fecha_finalizacion" class="form-label">Fecha Finalización</label>
                        <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" 
                            value="{{ old('fecha_finalizacion', $historia->fecha_finalizacion ? $historia->fecha_finalizacion->format('Y-m-d') : '') }}">
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary me-md-2">
                        <i class="fas fa-save"></i> Actualizar Historia
                    </button>
                    <a href="{{ route('board') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection