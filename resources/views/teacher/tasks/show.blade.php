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
                            Subject: <a href="{{ route('subjects.show', $task->subject) }}" class="text-primary-600 hover:text-primary-800">{{ $task->subject->name }}</a>
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 space-x-2 flex">
                        <a href="{{ route('tasks.edit', $task) }}" class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-700 active:bg-amber-800 focus:outline-none focus:border-amber-800 focus:ring ring-amber-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Task
                        </a>
                        <a href="{{ route('subjects.show', $task->subject) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-400 focus:ring ring-gray-300 disabled:opacity-25 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Subject
                        </a>
                    </div>
                </div>
                
                <!-- Task Statistics -->
                <div class="mt-6 grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                        <div class="p-4 flex items-center">
                            <div class="flex-shrink-0 bg-primary-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-primary-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-500">Total Points</h2>
                                <p class="text-lg font-semibold text-gray-900">{{ $task->points }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                        <div class="p-4 flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-500">Total Students</h2>
                                <p class="text-lg font-semibold text-gray-900">{{ $task->subject->students->count() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                        <div class="p-4 flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-500">Submissions</h2>
                                <p class="text-lg font-semibold text-gray-900">{{ $solutions->count() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                        <div class="p-4 flex items-center">
                            <div class="flex-shrink-0 bg-amber-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-sm font-medium text-gray-500">Evaluated</h2>
                                <p class="text-lg font-semibold text-gray-900">{{ $solutions->whereNotNull('points_obtained')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Task Description -->
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Task Description</h3>
                    <div class="bg-gray-50 rounded p-4 prose max-w-none">
                        {{ $task->description }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Solutions Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Student Submissions</h2>
                    
                    @if($solutions->count() > 0)
                        <span class="text-sm text-gray-500">{{ $solutions->count() }} submissions, {{ $solutions->whereNotNull('points_obtained')->count() }} evaluated</span>
                    @endif
                </div>

                @if($solutions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submission Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($solutions as $solution)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-primary-100 flex items-center justify-center">
                                                    <span class="text-primary-800 font-medium">{{ substr($solution->student->name, 0, 1) }}</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $solution->student->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $solution->student->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $solution->created_at->format('M d, Y') }}</div>
                                            <div class="text-sm text-gray-500">{{ $solution->created_at->format('h:i A') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($solution->points_obtained !== null)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Evaluated
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($solution->points_obtained !== null)
                                                <div class="text-sm font-medium 
                                                    {{ $solution->points_obtained == $task->points ? 'text-green-600' : 
                                                      ($solution->points_obtained == 0 ? 'text-red-600' : 'text-amber-600') }}">
                                                    {{ $solution->points_obtained }} / {{ $task->points }}
                                                </div>
                                            @else
                                                <div class="text-sm text-gray-500">Not graded</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if($solution->points_obtained === null)
                                                <a href="{{ route('solutions.edit', $solution) }}" class="inline-flex items-center px-3 py-1.5 bg-primary-600 border border-transparent rounded-md font-medium text-xs text-white hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-800 focus:ring ring-primary-300 disabled:opacity-25 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Evaluate
                                                </a>
                                            @else
                                                <a href="{{ route('solutions.edit', $solution) }}" class="text-primary-600 hover:text-primary-800 px-2 py-1 rounded hover:bg-gray-100 transition">
                                                    View Details
                                                </a>
                                            @endif
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
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No submissions yet</h3>
                        <p class="mt-2 text-sm text-gray-500">Students haven't submitted any solutions for this task yet.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Solution Details Modal (Hidden by default) -->
        <div id="solution-modal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-screen overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg font-medium text-gray-900" id="modal-title">Solution Details</h3>
                        <button type="button" onclick="closeSolutionModal()" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-4">
                        <div id="modal-content">
                            <!-- Content will be populated by JavaScript -->
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="button" onclick="closeSolutionModal()" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-transparent rounded-md hover:bg-gray-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary-500">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function viewSolutionDetails(solutionId, studentName, content, points, maxPoints) {
        const modal = document.getElementById('solution-modal');
        const modalTitle = document.getElementById('modal-title');
        const modalContent = document.getElementById('modal-content');
        
        modalTitle.textContent = `Solution from ${studentName}`;
        
        let pointsDisplay = 'Not evaluated yet';
        if (points !== null) {
            const percentage = (points / maxPoints) * 100;
            let colorClass = 'text-amber-600';
            
            if (percentage >= 90) {
                colorClass = 'text-green-600';
            } else if (percentage <= 50) {
                colorClass = 'text-red-600';
            }
            
            pointsDisplay = `<span class="${colorClass} font-medium">${points} / ${maxPoints} points (${percentage.toFixed(1)}%)</span>`;
        }
        
        modalContent.innerHTML = `
            <div class="mb-4">
                <p class="text-sm text-gray-500">Points:</p>
                <p class="text-base">${pointsDisplay}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Solution:</p>
                <div class="mt-2 bg-gray-50 p-4 rounded whitespace-pre-wrap">${content}</div>
            </div>
        `;
        
        modal.classList.remove('hidden');
    }
    
    function closeSolutionModal() {
        const modal = document.getElementById('solution-modal');
        modal.classList.add('hidden');
    }
    
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('solution-modal');
        if (event.target === modal) {
            closeSolutionModal();
        }
    });

    document.querySelector('#solution-modal > div').addEventListener('click', function(event) {
        event.stopPropagation();
    });
    
    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeSolutionModal();
        }
    });
</script>
@endsection