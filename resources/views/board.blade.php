<!DOCTYPE html>
<html>
<head>
    <title>Tablero de Historias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .kanban-board {
            display: flex;
            gap: 15px;
            padding: 20px;
            overflow-x: auto;
            min-height: 70vh;
        }
        .kanban-column {
            flex: 1;
            min-width: 300px;
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .story-card {
            background: white;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            position: relative;
            transition: all 0.3s ease;
        }
        .story-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .story-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }
        .state-nueva { border-left: 4px solid #6c757d; }
        .state-activa { border-left: 4px solid #0d6efd; }
        .state-finalizada { border-left: 4px solid #198754; }
        .state-impedimento { border-left: 4px solid #dc3545; }
        .story-info {
            margin-top: 10px;
            font-size: 0.9rem;
        }
        .story-info span {
            display: block;
            margin-bottom: 3px;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Tablero de Historias</h1>
            <div>
                <a href="{{ route('historias.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Crear Nueva Historia
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($historias && $historias->count() > 0)
        <div class="kanban-board">
            @foreach(['nueva' => 'Nueva', 'activa' => 'Activa', 'finalizada' => 'Finalizada', 'impedimento' => 'Impedimento'] as $estado => $titulo)
            <div class="kanban-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 mb-0">{{ $titulo }}</h3>
                    <span class="badge bg-secondary">{{ $historias->where('estado', $estado)->count() }}</span>
                </div>
                <div class="stories-list">
                    @foreach($historias->where('estado', $estado) as $historia)
                    <div class="story-card state-{{ $estado }}" data-id="{{ $historia->id }}">
                        <div class="story-actions">
                            <a href="{{ route('historias.edit', $historia->id) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('historias.destroy', $historia->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta historia?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                        <h5>{{ $historia->titulo }}</h5>
                        <p class="text-muted">{{ Str::limit($historia->descripcion, 100) }}</p>
                        
                        <div class="story-info">
                            <span><strong>Puntos:</strong> {{ $historia->puntos }}</span>
                            <span><strong>Responsable:</strong> {{ $historia->responsable }}</span>
                            <span><strong>Creada:</strong> {{ $historia->fecha_creacion->format('d/m/Y') }}</span>
                            @if($historia->fecha_finalizacion)
                            <span><strong>Finalizada:</strong> {{ $historia->fecha_finalizacion->format('d/m/Y') }}</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-info text-center py-4">
            <h4 class="alert-heading">No hay historias disponibles</h4>
            <p>Comienza creando tu primera historia de usuario</p>
            <a href="{{ route('historias.create') }}" class="btn btn-primary mt-2">
                <i class="fas fa-plus"></i> Crear Primera Historia
            </a>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        });
    </script>
</body>
</html>