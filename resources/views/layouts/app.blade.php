<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LMS') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                            950: '#1e1b4b',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    
    <!-- Additional Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-50 min-h-screen">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @auth
            <nav class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="flex-shrink-0 flex items-center">
                                <a href="{{ url('/dashboard') }}" class="text-xl font-bold text-primary-600">LMS</a>
                            </div>
                            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                                @if(auth()->user()->role == 'teacher')
                                    <a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.index') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        My Subjects
                                    </a>
                                    <a href="{{ route('subjects.create') }}" class="{{ request()->routeIs('subjects.create') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        New Subject
                                    </a>
                                @else
                                    <a href="{{ route('student.subjects.index') }}" class="{{ request()->routeIs('student.subjects.index') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        My Subjects
                                    </a>
                                    <a href="{{ route('student.subjects.create') }}" class="{{ request()->routeIs('student.subjects.create') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        Take Subject
                                    </a>
                                @endif
                                <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Contact
                                </a>
                            </div>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:items-center">
                            <div class="ml-3 relative">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-700 mr-3">{{ auth()->user()->name }}</span>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mobile menu button -->
                        <div class="flex items-center sm:hidden">
                            <button type="button" id="mobileMenuButton" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" aria-controls="mobile-menu" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="sm:hidden hidden" id="mobile-menu">
                    <div class="pt-2 pb-3 space-y-1">
                        @if(auth()->user()->role == 'teacher')
                            <a href="{{ route('subjects.index') }}" class="{{ request()->routeIs('subjects.index') ? 'bg-primary-50 border-primary-500 text-primary-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                                My Subjects
                            </a>
                            <a href="{{ route('subjects.create') }}" class="{{ request()->routeIs('subjects.create') ? 'bg-primary-50 border-primary-500 text-primary-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                                New Subject
                            </a>
                        @else
                            <a href="{{ route('student.subjects.index') }}" class="{{ request()->routeIs('student.subjects.index') ? 'bg-primary-50 border-primary-500 text-primary-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                                My Subjects
                            </a>
                            <a href="{{ route('student.subjects.create') }}" class="{{ request()->routeIs('student.subjects.create') ? 'bg-primary-50 border-primary-500 text-primary-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                                Take Subject
                            </a>
                        @endif
                        <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'bg-primary-50 border-primary-500 text-primary-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                            Contact
                        </a>
                        <div class="pt-4 pb-3 border-t border-gray-200">
                            <div class="flex items-center px-4">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 rounded-full bg-primary-200 flex items-center justify-center">
                                        <span class="text-primary-800 font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-base font-medium text-gray-800">{{ auth()->user()->name }}</div>
                                    <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                            <div class="mt-3 space-y-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-red-600 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        @else
            <!-- Guest Navigation -->
            <nav class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="flex-shrink-0 flex items-center">
                                <a href="{{ url('/') }}" class="text-xl font-bold text-primary-600">LMS</a>
                            </div>
                            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                                <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Home
                                </a>
                                <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'border-primary-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    Contact
                                </a>
                            </div>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 bg-gray-100 px-4 py-2 rounded-md hover:bg-gray-200 transition">Log in</a>
                            <a href="{{ route('register') }}" class="text-sm text-white bg-primary-600 px-4 py-2 rounded-md hover:bg-primary-700 transition">Register</a>
                        </div>
                        
                        <!-- Mobile menu button -->
                        <div class="flex items-center sm:hidden">
                            <button type="button" id="guestMobileMenuButton" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" aria-controls="guest-mobile-menu" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="sm:hidden hidden" id="guest-mobile-menu">
                    <div class="pt-2 pb-3 space-y-1">
                        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'bg-primary-50 border-primary-500 text-primary-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                            Home
                        </a>
                        <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'bg-primary-50 border-primary-500 text-primary-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                            Contact
                        </a>
                        <div class="pt-4 pb-3 border-t border-gray-200">
                            <div class="mt-3 space-y-1">
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-600 hover:bg-gray-100">
                                    Log in
                                </a>
                                <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-primary-600 hover:bg-gray-100">
                                    Register
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        @endauth

        <!-- Page Content -->
        <main class="flex-grow">
            @if (session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                        <ul class="list-disc pl-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <p class="text-sm text-gray-500">&copy; {{ date('Y') }} Learning Management System. All rights reserved.</p>
                    </div>
                    <div class="flex space-x-6">
                        <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-gray-700">Home</a>
                        <a href="{{ url('/contact') }}" class="text-sm text-gray-500 hover:text-gray-700">Contact</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript for mobile menu toggle -->
    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    
        const guestMobileMenuButton = document.getElementById('guestMobileMenuButton');
        const guestMobileMenu = document.getElementById('guest-mobile-menu');
        
        if (guestMobileMenuButton && guestMobileMenu) {
            guestMobileMenuButton.addEventListener('click', () => {
                guestMobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>