@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0">Crear Nueva Historia de Usuario</h2>
                <a href="{{ route('board') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left"></i> Volver al Tablero
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form action="{{ route('historias.store') }}" method="POST">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="titulo" class="form-label">Título*</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="puntos" class="form-label">Puntos de Complejidad (1-10)*</label>
                        <input type="number" class="form-control" id="puntos" name="puntos" min="1" max="10" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción*</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="estado" class="form-label">Estado*</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="nueva">Nueva</option>
                            <option value="activa">Activa</option>
                            <option value="finalizada">Finalizada</option>
                            <option value="impedimento">Impedimento</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="fecha_creacion" class="form-label">Fecha Creación*</label>
                        <input type="date" class="form-control" id="fecha_creacion" name="fecha_creacion" required>
                    </div>
                    
                    <!-- Campo de Sprint comentado temporalmente -->
                    
                    <div class="col-md-4">
                        <label for="sprint_id" class="form-label">Sprint</label>
                        <select class="form-select" id="sprint_id" name="sprint_id">
                            @foreach($sprints as $sprint)
                            <option value="{{ $sprint->id }}">{{ $sprint->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div> 
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="responsable" class="form-label">Responsable*</label>
                        <input type="text" class="form-control" id="responsable" name="responsable" required>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Historia
                    </button>
                </div>
            </form>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection