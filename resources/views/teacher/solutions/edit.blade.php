@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Solution Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="flex items-center">
                            <h1 class="text-2xl font-bold text-gray-900">Evaluate Solution</h1>
                            @if($solution->points_obtained !== null)
                                <span class="ml-3 bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                                    Already Evaluated
                                </span>
                            @else
                                <span class="ml-3 bg-yellow-100 text-yellow-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                                    Pending Evaluation
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            Task: <a href="{{ route('tasks.show', $task) }}" class="text-primary-600 hover:text-primary-800">{{ $task->name }}</a>
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 space-x-2 flex">
                        <a href="{{ route('tasks.show', $task) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Task
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Column - Solution Details -->
            <div class="md:col-span-2 space-y-6">
                <!-- Student Info and Submission Details -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Student Information</h2>
                        
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-primary-100 flex items-center justify-center">
                                <span class="text-xl text-primary-800 font-medium">{{ substr($solution->student->name, 0, 1) }}</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $solution->student->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $solution->student->email }}</p>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex flex-wrap gap-y-2">
                                <div class="w-full sm:w-1/2">
                                    <p class="text-xs text-gray-500">Submission Date</p>
                                    <p class="text-sm font-medium">{{ $solution->created_at->format('F j, Y') }}</p>
                                </div>
                                <div class="w-full sm:w-1/2">
                                    <p class="text-xs text-gray-500">Submission Time</p>
                                    <p class="text-sm font-medium">{{ $solution->created_at->format('g:i A') }}</p>
                                </div>
                                @if($solution->points_obtained !== null)
                                <div class="w-full sm:w-1/2">
                                    <p class="text-xs text-gray-500">Evaluation Date</p>
                                    <p class="text-sm font-medium">{{ $solution->updated_at->format('F j, Y') }}</p>
                                </div>
                                <div class="w-full sm:w-1/2">
                                    <p class="text-xs text-gray-500">Current Points</p>
                                    <p class="text-sm font-medium">
                                        <span class="{{ $solution->points_obtained == $task->points ? 'text-green-600' : ($solution->points_obtained == 0 ? 'text-red-600' : 'text-amber-600') }}">
                                            {{ $solution->points_obtained }} / {{ $task->points }}
                                        </span>
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Task Description -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Task Description</h2>
                        <div class="bg-gray-50 rounded p-4 prose max-w-none">
                            {{ $task->description }}
                        </div>
                    </div>
                </div>

                <!-- Student Solution -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Student Solution</h2>
                        <div class="bg-gray-50 rounded p-4">
                            <pre class="whitespace-pre-wrap text-sm">{{ $solution->content }}</pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Evaluation Form -->
            <div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Evaluation</h2>
                        
                        <form method="POST" action="{{ route('solutions.update', $solution) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="space-y-6">
                                <!-- Points Input -->
                                <div>
                                    <label for="points_obtained" class="block text-sm font-medium text-gray-700">Points Obtained</label>
                                    <div class="mt-1 relative">
                                        <input type="number" id="points_obtained" name="points_obtained" 
                                            min="0" max="{{ $task->points }}" value="{{ old('points_obtained', $solution->points_obtained) }}"
                                            class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                            required>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">/ {{ $task->points }}</span>
                                        </div>
                                    </div>
                                    @error('points_obtained')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p class="mt-2 text-xs text-gray-500">
                                        Minimum: 0, Maximum: {{ $task->points }}
                                    </p>
                                </div>
                                
                                <!-- Quick Points Buttons -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Quick Select</label>
                                    <div class="flex flex-wrap gap-2">
                                        <button type="button" onclick="document.getElementById('points_obtained').value='0'" 
                                            class="px-2 py-1 bg-gray-200 text-gray-700 rounded text-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                            0 points
                                        </button>
                                        <button type="button" onclick="document.getElementById('points_obtained').value='{{ floor($task->points / 2) }}'" 
                                            class="px-2 py-1 bg-gray-200 text-gray-700 rounded text-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                            Half ({{ floor($task->points / 2) }})
                                        </button>
                                        <button type="button" onclick="document.getElementById('points_obtained').value='{{ $task->points }}'" 
                                            class="px-2 py-1 bg-gray-200 text-gray-700 rounded text-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                            Full ({{ $task->points }})
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Submit Button -->
                                <div class="pt-4 border-t border-gray-200">
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Save Evaluation
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection