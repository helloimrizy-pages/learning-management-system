@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Subject Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="flex items-center">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $subject->name }}</h1>
                            <span class="ml-3 bg-gray-100 text-gray-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                                {{ $subject->credit }} credit{{ $subject->credit !== 1 ? 's' : '' }}
                            </span>
                        </div>
                        <div class="text-sm font-mono bg-gray-100 inline-block px-2 py-1 rounded mt-2">
                            {{ $subject->code }}
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 space-x-2 flex">
                        <form action="{{ route('student.subjects.destroy', $subject) }}" method="POST" onsubmit="return confirm('Are you sure you want to leave this subject?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring ring-red-300 disabled:opacity-25 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Leave Subject
                            </button>
                        </form>
                        <a href="{{ route('student.subjects.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Subjects
                        </a>
                    </div>
                </div>
                
                <!-- Subject Details -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Description</h3>
                        <div class="bg-gray-50 rounded p-4 prose max-w-none">
                            <p>{{ $subject->description ?: 'No description available.' }}</p>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Details</h3>
                        <div class="bg-gray-50 rounded p-4">
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Instructor</p>
                                    <p class="text-sm font-medium">{{ $subject->teacher->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $subject->teacher->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Created</p>
                                    <p class="text-sm font-medium">{{ $subject->created_at->format('F j, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Last Updated</p>
                                    <p class="text-sm font-medium">{{ $subject->updated_at->format('F j, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Students</p>
                                    <p class="text-sm font-medium">{{ $students->count() }} enrolled</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="mb-6">
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <select id="tabs" name="tabs" onchange="window.location.hash = this.value" class="block w-full focus:ring-primary-500 focus:border-primary-500 border-gray-300 rounded-md">
                    <option value="#tasks" selected>Tasks</option>
                    <option value="#students">Students</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <nav class="flex space-x-4" aria-label="Tabs">
                    <button onclick="showTab('tasks')" class="tab-btn px-3 py-2 text-sm font-medium rounded-md active-tab" aria-current="page">
                        Tasks
                    </button>
                    <button onclick="showTab('students')" class="tab-btn px-3 py-2 text-sm font-medium rounded-md">
                        Students
                    </button>
                </nav>
            </div>
        </div>

        <!-- Tasks Tab -->
        <div id="tasks-tab" class="tab-content">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Tasks</h2>
                    </div>

                    @if(count($tasks) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($tasks as $task)
                                        @php
                                            $submitted = $task->solutions->where('user_id', auth()->id())->count() > 0;
                                            $statusClass = $submitted ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
                                            $statusText = $submitted ? 'Submitted' : 'Not Submitted';
                                        @endphp
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $task->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $task->points }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                    {{ $statusText }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $task->created_at->format('M d, Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('student.tasks.show', $task) }}" class="inline-flex items-center px-3 py-1.5 bg-primary-600 border border-transparent rounded-md font-medium text-xs text-white hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    {{ $submitted ? 'View Submission' : 'Submit Solution' }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No tasks available</h3>
                            <p class="mt-2 text-sm text-gray-500">The instructor hasn't added any tasks to this subject yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Students Tab -->
        <div id="students-tab" class="tab-content hidden">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Enrolled Students</h2>
                    </div>

                    @if(count($students) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($students as $student)
                                        <tr class="hover:bg-gray-50 {{ $student->id === auth()->id() ? 'bg-primary-50' : '' }}">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $student->name }}
                                                    @if($student->id === auth()->id())
                                                        <span class="ml-2 bg-primary-100 text-primary-800 text-xs px-2 py-0.5 rounded">You</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $student->email }}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-lg p-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No students enrolled</h3>
                            <p class="mt-2 text-sm text-gray-500">Be the first to take this subject!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        document.getElementById(tabName + '-tab').classList.remove('hidden');
        
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('bg-gray-100', 'text-gray-900', 'active-tab');
            btn.classList.add('text-gray-500', 'hover:text-gray-700', 'hover:bg-gray-50');
        });
        
        event.currentTarget.classList.add('bg-gray-100', 'text-gray-900', 'active-tab');
        event.currentTarget.classList.remove('text-gray-500', 'hover:text-gray-700', 'hover:bg-gray-50');
    }

    window.addEventListener('load', function() {
        const hash = window.location.hash.substring(1);
        if (hash === 'students') {
            document.querySelector('.tab-btn:nth-child(2)').click();
        }
    });
</script>

<style>
    .active-tab {
        @apply bg-gray-100 text-gray-900;
    }
    .tab-btn:not(.active-tab) {
        @apply text-gray-500 hover:text-gray-700 hover:bg-gray-50;
    }
</style>
@endsection