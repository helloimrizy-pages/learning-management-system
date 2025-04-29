<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>LMS</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 p-5">
    @auth
        <nav class="mb-5">
            @if(auth()->user()->role == 'teacher')
                <a href="{{ route('subjects.index') }}" class="mr-4">My Subjects</a>
                <a href="{{ route('subjects.create') }}" class="mr-4">New Subject</a>
            @else
                <a href="{{ route('student.subjects.index') }}" class="mr-4">My Subjects</a>
                <a href="{{ route('student.subjects.create') }}" class="mr-4">Take Subject</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button class="text-red-500">Logout</button>
            </form>
        </nav>
    @endauth

    @yield('content')
</body>
</html>