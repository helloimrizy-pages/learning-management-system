@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">My Subjects</h1>

@if (session('success'))
    <div class="text-green-500">{{ session('success') }}</div>
@endif

<ul>
    @foreach($subjects as $subject)
        <li class="mb-2">
            <a href="{{ route('student.subjects.show', $subject) }}" class="text-blue-500">{{ $subject->name }}</a>
            <form action="{{ route('student.subjects.destroy', $subject) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button class="text-red-500 ml-2">Leave</button>
            </form>
        </li>
    @endforeach
</ul>
@endsection
