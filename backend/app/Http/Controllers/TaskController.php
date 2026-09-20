<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Lister toutes les tâches
    public function index()
    {
        return response()->json(Task::latest()->get());
    }

    // Créer une tâche
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'sometimes|boolean',
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    // Afficher une tâche
    public function show(Task $task)
    {
        return response()->json($task);
    }

    // Modifier une tâche
    public function update(Request $request, Task $task)
{
    $validated = $request->validate([
        'title' => 'sometimes|required|string|max:255',
        'description' => 'nullable|string',
        'completed' => 'sometimes|boolean',
    ]);

    $task->update($validated);

    return response()->json($task);
}

    // Supprimer une tâche
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json([
            'message' => 'Tâche supprimée avec succès'
        ]);
    }
}
