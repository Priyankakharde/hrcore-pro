<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HRCore Pro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        body{
            font-family:'Inter',sans-serif;
        }

    </style>

</head>

<body class="bg-[#f5f6fa]">

<div class="flex min-h-screen">

    <!-- ================= SIDEBAR ================= -->

    <aside class="w-72 bg-white border-r border-gray-200 flex flex-col justify-between">

        <div>

            <!-- ================= LOGO ================= -->

            <div class="px-8 py-8 border-b border-gray-100">

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 flex items-center justify-center shadow-lg">

                        <span class="text-white text-2xl">

                            🏢

                        </span>

                    </div>

                    <div>

                        <h1 class="text-3xl font-extrabold text-gray-800">

                            HRCore Pro

                        </h1>

                        <p class="text-sm text-gray-500 mt-1">

                            Human Resource Management

                        </p>

                    </div>

                </div>

            </div>

            <!-- ================= MENU ================= -->

            <div class="px-8 mt-8 mb-4">

                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">

                    Main Menu

                </h3>

            </div>

            <nav class="space-y-2 px-3">
                <!-- ================= DASHBOARD ================= -->

<a href="{{ route('dashboard') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('dashboard')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('dashboard')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        📊

    </div>

    <span>Dashboard</span>

</a>

<!-- ================= EMPLOYEES ================= -->

<a href="{{ route('employees.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('employees.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('employees.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        👨‍💼

    </div>

    <span>Employees</span>

</a>

<!-- ================= TASK BOARD ================= -->

<a href="{{ route('tasks.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('tasks.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('tasks.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        🗂️

    </div>

    <span>Task Board</span>

</a>

<!-- ================= EVENTS ================= -->

<a href="{{ route('events.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('events.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('events.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        📅

    </div>

    <span>Events</span>

</a>

<!-- ================= PROJECTS ================= -->

<a href="{{ route('projects.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('projects.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('projects.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        💼

    </div>

    <span>Projects</span>

</a>
<!-- ================= LEAVE MANAGEMENT ================= -->

<a href="{{ route('leaves.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('leaves.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('leaves.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        🏖️

    </div>

    <span>Leave Management</span>

</a>

<!-- ================= PAYMENT ================= -->

<a href="{{ route('payments.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('payments.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('payments.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        💳

    </div>

    <span>Payment</span>

</a>

<!-- ================= PERFORMANCE ================= -->

<a href="{{ route('performance.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('performance.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('performance.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        📈

    </div>

    <span>Performance</span>

</a>

<!-- ================= INVOICE ================= -->

<a href="{{ route('invoice.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('invoice.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('invoice.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        🧾

    </div>

    <span>Invoice</span>

</a>

<!-- ================= CHAT ================= -->

<a href="{{ route('chat.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('chat.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('chat.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        💬

    </div>

    <span>Chat</span>

</a>

<!-- ================= NOTIFICATION ================= -->

<a href="{{ route('notifications.index') }}"
   class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
   {{ request()->routeIs('notifications.*')
       ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
       : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

    <div class="w-10 h-10 rounded-xl flex items-center justify-center
    {{ request()->routeIs('notifications.*')
        ? 'bg-white/20'
        : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

        🔔

    </div>

    <span>Notification</span>

</a>

</nav>

</div>
<!-- ================= ACCOUNT ================= -->

<div class="mb-8 border-t border-gray-200 pt-6">

    <div class="px-8 mb-4">

        <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400">

            Account

        </h3>

    </div>

    <div class="space-y-2 px-3">

        <!-- ================= PROFILE ================= -->

        <a href="{{ route('profile.edit') }}"
           class="group flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition-all duration-300
           {{ request()->routeIs('profile.*')
               ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-xl'
               : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">

            <div class="w-10 h-10 rounded-xl flex items-center justify-center
            {{ request()->routeIs('profile.*')
                ? 'bg-white/20'
                : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }}">

                👤

            </div>

            <span>

                Profile

            </span>

        </a>

        <!-- ================= LOGOUT ================= -->

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                type="submit"
                class="group w-full flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold text-red-600 hover:bg-red-50 transition">

                <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition">

                    🚪

                </div>

                <span>

                    Logout

                </span>

            </button>

        </form>

    </div>

</div>

</aside>

<!-- ================= MAIN CONTENT ================= -->

<main class="flex-1 flex flex-col">
    <!-- ================= TOPBAR ================= -->

<header class="bg-white border-b border-gray-200 px-8 py-5">

    <div class="flex flex-col lg:flex-row items-center justify-between gap-6">

        <!-- Left -->

        <div>

            <h2 class="text-3xl font-bold text-gray-800">

                Welcome Back 👋

            </h2>

            <p class="text-gray-500 mt-1">

                Manage your HR operations efficiently.

            </p>

        </div>

        <!-- Right -->

        <div class="flex items-center gap-5">

            <!-- Search -->

            <div class="relative">

                <input
                    type="text"
                    placeholder="Search..."
                    class="w-72 rounded-2xl border border-gray-300 bg-gray-50 pl-12 pr-5 py-3 focus:border-blue-500 focus:ring-blue-500">

                <span class="absolute left-4 top-3.5 text-gray-400">

                    🔍

                </span>

            </div>

            <!-- Chat -->

            <button
                class="relative w-12 h-12 rounded-2xl bg-gray-100 hover:bg-blue-600 hover:text-white transition flex items-center justify-center">

                💬

                <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500"></span>

            </button>

            <!-- Notification -->

            <button
                class="relative w-12 h-12 rounded-2xl bg-gray-100 hover:bg-blue-600 hover:text-white transition flex items-center justify-center">

                🔔

                <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-red-500"></span>

            </button>

            <!-- User -->

            <div class="flex items-center gap-4 bg-gray-50 rounded-2xl px-4 py-2">

                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=ffffff"
                    alt="User"
                    class="w-12 h-12 rounded-full shadow">

                <div>

                    <h3 class="font-bold text-gray-800">

                        {{ Auth::user()->name }}

                    </h3>

                    <p class="text-sm text-gray-500">

                        Administrator

                    </p>

                </div>

            </div>

        </div>

    </div>

</header>

<!-- ================= PAGE CONTENT ================= -->

<div class="flex-1 p-8 overflow-y-auto">

    @if(session('success'))

        <div class="mb-6 rounded-2xl bg-green-100 border border-green-300 text-green-700 px-6 py-4">

            {{ session('success') }}

        </div>

    @endif

    @yield('content')

</div>

</main>

</div>

</body>

</html>