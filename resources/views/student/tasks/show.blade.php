@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Task Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="flex items-center">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $task->name }}</h1>
                            <span class="ml-3 bg-primary-100 text-primary-800 text-sm font-medium px-2.5 py-0.5 rounded-full">
                                {{ $task->points }} points
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            Subject: <a href="{{ route('student.subjects.show', $task->subject) }}" class="text-primary-600 hover:text-primary-800">{{ $task->subject->name }}</a>
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 space-x-2 flex">
                        <a href="{{ route('student.subjects.show', $task->subject) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Subject
                        </a>
                    </div>
                </div>
                
                <!-- Task Details -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Task Description</h3>
                        <div class="bg-gray-50 rounded p-4 prose max-w-none">
                            {{ $task->description }}
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Details</h3>
                        <div class="bg-gray-50 rounded p-4">
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-gray-500">Points</p>
                                    <p class="text-sm font-medium">{{ $task->points }} points</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Instructor</p>
                                    <p class="text-sm font-medium">{{ $task->subject->teacher->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Created</p>
                                    <p class="text-sm font-medium">{{ $task->created_at->format('F j, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Submission Status</p>
                                    <p class="text-sm font-medium">
                                        @if(count($existingSolutions) > 0)
                                            <span class="text-green-600">Submitted</span> ({{ count($existingSolutions) }} submission{{ count($existingSolutions) !== 1 ? 's' : '' }})
                                        @else
                                            <span class="text-yellow-600">Not submitted</span>
                                        @endif
                                    </p>
                                </div>
                                @if(count($existingSolutions) > 0 && $existingSolutions->first()->points_obtained !== null)
                                <div>
                                    <p class="text-sm text-gray-500">Your Points</p>
                                    <p class="text-sm font-medium">
                                        <span class="{{ $existingSolutions->first()->points_obtained == $task->points ? 'text-green-600' : ($existingSolutions->first()->points_obtained == 0 ? 'text-red-600' : 'text-amber-600') }}">
                                            {{ $existingSolutions->first()->points_obtained }} / {{ $task->points }}
                                        </span>
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Previous Submissions -->
        @if(count($existingSolutions) > 0)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Your Previous Submissions</h2>
                
                <div class="space-y-6">
                    @foreach($existingSolutions as $solution)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-gray-50 px-4 py-2 border-b border-gray-200 flex justify-between items-center">
                            <div class="text-sm">
                                <span class="font-medium">Submitted on:</span> {{ $solution->created_at->format('F j, Y \a\t g:i a') }}
                            </div>
                            <div>
                                @if($solution->points_obtained !== null)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $solution->points_obtained == $task->points ? 'bg-green-100 text-green-800' : ($solution->points_obtained == 0 ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800') }}">
                                        {{ $solution->points_obtained }} / {{ $task->points }} points
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Not evaluated yet
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="p-4 bg-white">
                            <pre class="bg-gray-50 p-3 rounded whitespace-pre-wrap text-sm">{{ $solution->content }}</pre>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Submit Solution Form -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Submit Solution</h2>
                
                <form method="POST" action="{{ route('student.tasks.submit', $task) }}">
                    @csrf
                    
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Your Solution</label>
                        <div class="mt-1">
                            <textarea id="content" name="content" rows="10" 
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md @error('content') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                placeholder="Write your solution here..." required>{{ old('content') }}</textarea>
                        </div>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        
                        @if(count($existingSolutions) > 0)
                            <p class="mt-2 text-sm text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline -mt-1 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                You've already submitted a solution. Submitting again will create an additional submission.
                            </p>
                        @endif
                    </div>
                    
                    <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Submit Solution
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection