<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use App\Models\Sprint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HistoriaController extends Controller
{
    // Listar todas las historias
    public function index()
{
    return view('board', [
        'historias' => Historia::with('sprint')->latest()->get()
    ]);
}

    // Mostrar el formulario de creación 
    public function create()
    {
        $sprints = Sprint::all(); 
        $estados = ['nueva', 'activa', 'finalizada', 'impedimento']; 
        $sprints = Sprint::all(); 
        return view('historias.create', compact('sprints', 'estados'));
    }

    // Guardar nueva historia
    public function store(Request $request)
{
    $validated = $request->validate([
        'titulo' => 'required|string|max:150',
        'descripcion' => 'required|string',
        'puntos' => 'required|integer|min:1|max:10',
        'estado' => 'required|in:nueva,activa,finalizada,impedimento',
        'fecha_creacion' => 'required|date',
        'responsable' => 'required|string|max:100',
        'sprint_id' => 'required|exists:sprints,id',
    ]);

    Historia::create($validated);

    return redirect()->route('board')->with('success', 'Historia creada exitosamente!');
}

    // Mostrar formulario de edición
    public function edit(Historia $historia)
    {
        return view('historias.edit', [
            'historia' => $historia,
            'sprints' => Sprint::all(),
            'estados' => ['nueva', 'activa', 'finalizada', 'impedimento']
        ]);
    }

    // Actualizar historia existente
    public function update(Request $request, Historia $historia)
    {
        $validated = $request->validate([
            'titulo' => 'sometimes|string|max:150',
            'descripcion' => 'sometimes|string',
            'puntos' => 'sometimes|integer|min:1|max:10',
            'estado' => 'sometimes|in:nueva,activa,finalizada,impedimento',
            'fecha_finalizacion' => 'nullable|date',
            'sprint_id' => 'sometimes|exists:sprints,id'
        ]);

        $historia->update($validated);

        return redirect()->route('board')
            ->with('success', 'Historia actualizada!');
    }

    // Eliminar historia
    public function destroy(Historia $historia)
    {
        $historia->delete();
        return back()->with('success', 'Historia eliminada!');
    }

    public function board()
{
    $historias = Historia::with('sprint')->get();
    return view('board', compact('historias'));
}
}