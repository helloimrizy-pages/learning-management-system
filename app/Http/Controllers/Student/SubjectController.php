<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = auth()->user()->subjectsTaken;
        return view('student.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $takenSubjectIds = auth()->user()->subjectsTaken()->pluck('subject_id')->toArray();
        $subjects = Subject::whereNotIn('id', $takenSubjectIds)->get();

        return view('student.subjects.take', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subject = Subject::findOrFail($request->subject_id);
        auth()->user()->subjectsTaken()->attach($subject);

        return redirect()->route('student.subjects.index')->with('success', 'Subject taken successfully.');
    }

    /**
     * Display the specified resource.
     */


    public function show(Subject $subject)
    {
        if (!auth()->user()->subjectsTaken->contains($subject)) {
            abort(403);
        }

        $tasks = $subject->tasks;
        $students = $subject->students;

        return view('student.subjects.show', compact('subject', 'tasks', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        auth()->user()->subjectsTaken()->detach($subject);
        return redirect()->route('student.subjects.index')->with('success', 'Subject left.');
    }
}
