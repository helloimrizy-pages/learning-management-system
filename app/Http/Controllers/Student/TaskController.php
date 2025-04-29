<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Solution;

class TaskController extends Controller
{
    public function show(Task $task)
    {
        $user = auth()->user();

        if (!$user->subjectsTaken->contains($task->subject)) {
            abort(403);
        }

        $existingSolutions = $task->solutions()->where('user_id', $user->id)->get();

        return view('student.tasks.show', compact('task', 'existingSolutions'));
    }

    public function store(Request $request, Task $task)
    {
        $user = auth()->user();

        if (!$user->subjectsTaken->contains($task->subject)) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $task->solutions()->create([
            'user_id' => $user->id,
            'content' => $validated['content'],
        ]);

        return redirect()->route('student.tasks.show', $task)->with('success', 'Solution submitted.');
    }
}
