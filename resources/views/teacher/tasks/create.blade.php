@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="mb-6 border-b pb-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Create New Task</h2>
                        <a href="{{ route('subjects.show', $subject) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            Back to Subject
                        </a>
                    </div>
                    <p class="mt-1 text-sm text-gray-600">
                        Create a new task for <span class="font-medium">{{ $subject->name }}</span> ({{ $subject->code }}).
                    </p>
                </div>

                <form method="POST" action="{{ route('tasks.store', $subject) }}">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Task Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Task Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
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
                            <input type="number" name="points" id="points" value="{{ old('points') }}" 
                                class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('points') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                placeholder="e.g. 10" required min="1">
                            @error('points')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">Minimum value is 1 point.</p>
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Task Description</label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="10" 
                                    class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md @error('description') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror"
                                    placeholder="Enter a detailed description of the task and its requirements..." required>{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">
                                Provide clear instructions for students.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
                        <a href="{{ route('subjects.show', $subject) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 mr-3">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Create Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection