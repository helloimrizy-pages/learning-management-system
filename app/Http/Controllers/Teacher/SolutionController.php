<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solution;

class SolutionController extends Controller
{
    public function edit(Solution $solution)
    {
        $task = $solution->task;
        return view('teacher.solutions.edit', compact('solution', 'task'));
    }

    public function update(Request $request, Solution $solution)
    {
        $maxPoints = $solution->task->points;

        $validated = $request->validate([
            'points_obtained' => "required|integer|min:0|max:$maxPoints",
        ]);

        $solution->update($validated);

        return redirect()->route('tasks.show', $solution->task)->with('success', 'Solution evaluated.');
    }
}
