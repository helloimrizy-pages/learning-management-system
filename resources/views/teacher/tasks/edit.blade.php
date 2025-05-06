@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="mb-6 border-b pb-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Edit Task</h2>
                        <a href="{{ route('tasks.show', $task) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            Back to Task Details
                        </a>
                    </div>
                    <p class="mt-1 text-sm text-gray-600">
                        Edit the information for <span class="font-medium">{{ $task->name }}</span> in subject <span class="font-medium">{{ $task->subject->name }}</span>.
                    </p>
                </div>

                <form method="POST" action="{{ route('tasks.update', $task) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Task Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Task Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $task->name) }}" 
                                class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                placeholder="e.g. Midterm Assignment" required minlength="5">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">Minimum 5 characters required.</p>
                        </div>
                        
                        <!-- Points -->
                        <div>
                            <label for="points" class="block text-sm font-medium text-gray-700">Points</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <input type="number" name="points" id="points" value="{{ old('points', $task->points) }}" 
                                    class="focus:ring-primary-500 focus:border-primary-500 block w-full pr-20 sm:text-sm border-gray-300 rounded-md @error('points') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                    placeholder="e.g. 10" required min="1">
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <label for="points" class="sr-only">Points</label>
                                    <span class="text-gray-500 sm:text-sm pr-4">
                                        points
                                    </span>
                                </div>
                            </div>
                            @error('points')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <!-- <p class="mt-2 text-xs text-gray-500">
                                <span class="text-amber-600 font-medium">Note:</span> Changing the point value will not automatically update existing evaluations.
                            </p> -->
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Task Description</label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="10" 
                                    class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md @error('description') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                    placeholder="Enter a detailed description of the task and its requirements..." required>{{ old('description', $task->description) }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">
                                Provide clear instructions for students. You can use basic formatting like lists, bold, italics, etc.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                        <div class="text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $task->solutions->count() }} student{{ $task->solutions->count() !== 1 ? 's have' : ' has' }} already submitted solutions.
                            </span>
                        </div>

                        <div class="flex space-x-3">
                            <a href="{{ route('tasks.show', $task) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Update Task
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection