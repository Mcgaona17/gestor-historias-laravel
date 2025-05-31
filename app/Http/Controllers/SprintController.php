<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SprintController extends Controller
{
    public function index()
    {
        return response()->json([
            'sprints' => Sprint::withCount('historias')->with('historias')->get()
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'fecha_fin' => 'required|date|after:fecha_inicio'
        ]);

        $sprint = Sprint::create($validated);
        
        return response()->json([
            'message' => 'Sprint creado exitosamente',
            'sprint' => $sprint
        ], Response::HTTP_CREATED);
    }
}