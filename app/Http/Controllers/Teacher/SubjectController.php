<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SubjectController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = auth()->user()->subjectsTaught;
        return view('teacher.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'code' => 'required|regex:/^IK-[A-Z]{3}[0-9]{3}$/|unique:subjects,code',
            'credit' => 'required|integer',
        ]);

        auth()->user()->subjectsTaught()->create($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $this->authorize('view', $subject);
        $students = $subject->students;
        $tasks = $subject->tasks;
        return view('teacher.subjects.show', compact('subject', 'students', 'tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $this->authorize('update', $subject);
        return view('teacher.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);

        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'nullable',
            'code' => 'required|regex:/^IK-[A-Z]{3}[0-9]{3}$/|unique:subjects,code,' . $subject->id,
            'credit' => 'required|integer',
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.show', $subject)->with('success', 'Subject updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);

        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted.');
    }
}
