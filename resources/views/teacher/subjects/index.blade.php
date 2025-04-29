@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">My Subjects</h1>

@if (session('success'))
    <div class="text-green-500">{{ session('success') }}</div>
@endif

<ul>
    @foreach($subjects as $subject)
        <li><a href="{{ route('subjects.show', $subject) }}" class="text-blue-500">{{ $subject->name }}</a></li>
    @endforeach
</ul>
@endsection
