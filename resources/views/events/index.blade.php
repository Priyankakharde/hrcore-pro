@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Events Management
            </h1>

            <p class="text-gray-500 mt-2">
                Manage all company events from one place
            </p>

        </div>

        <a href="{{ route('events.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg transition">

            + Create Event

        </a>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- TOTAL -->
        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <p class="text-gray-400">
                Total Events
            </p>

            <h2 class="text-5xl font-bold mt-4">
                {{ $totalEvents }}
            </h2>

        </div>

        <!-- UPCOMING -->
        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <p class="text-yellow-500">
                Upcoming
            </p>

            <h2 class="text-5xl font-bold mt-4">
                {{ $upcomingEvents }}
            </h2>

        </div>

        <!-- ONGOING -->
        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <p class="text-blue-500">
                Ongoing
            </p>

            <h2 class="text-5xl font-bold mt-4">
                {{ $ongoingEvents }}
            </h2>

        </div>

        <!-- COMPLETED -->
        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <p class="text-green-500">
                Completed
            </p>

            <h2 class="text-5xl font-bold mt-4">
                {{ $completedEvents }}
            </h2>

        </div>

    </div>

    <!-- EVENT LIST -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

        @forelse($events as $event)

        @php

        $statusClass = match($event->status) {
            'Upcoming' => 'bg-yellow-100 text-yellow-600',
            'Ongoing' => 'bg-blue-100 text-blue-600',
            'Completed' => 'bg-green-100 text-green-600',
            default => 'bg-red-100 text-red-600'
        };

        @endphp

        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">

            <!-- TOP -->
            <div class="flex justify-between items-start">

                <div>

                    <div class="flex gap-3 items-center mb-4">

                        <!-- EVENT TYPE -->
                        <span class="px-4 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-600">

                            {{ $event->event_type }}

                        </span>

                        <!-- PRIORITY -->
                        <span class="px-4 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-600">

                            {{ $event->priority }}

                        </span>

                    </div>

                    <!-- TITLE -->
                    <h2 class="text-3xl font-bold text-gray-800">

                        {{ $event->title }}

                    </h2>

                </div>

                <!-- STATUS -->
                <span class="px-4 py-2 rounded-full text-sm font-medium {{ $statusClass }}">

                    {{ $event->status }}

                </span>

            </div>

            <!-- DETAILS -->
            <div class="mt-6 space-y-3 text-gray-600">

                <p>
                    📅 {{ $event->event_date }}
                </p>

                <p>
                    ⏰ {{ $event->start_time }} - {{ $event->end_time }}
                </p>

                <p>
                    📍 {{ $event->location }}
                </p>

                <p>
                    👤 Organizer: {{ $event->organizer }}
                </p>

            </div>

            <!-- DESCRIPTION -->
            <p class="mt-6 text-gray-500 leading-relaxed">

                {{ $event->description }}

            </p>

            <!-- ACTIONS -->
            <div class="flex gap-4 mt-8">

                <!-- VIEW -->
                <a href="{{ route('events.show', $event->id) }}"
                   class="px-5 py-3 rounded-xl bg-blue-100 text-blue-600 font-medium hover:bg-blue-200 transition">

                    View

                </a>

                <!-- EDIT -->
                <a href="{{ route('events.edit', $event->id) }}"
                   class="px-5 py-3 rounded-xl bg-purple-100 text-purple-600 font-medium hover:bg-purple-200 transition">

                    Edit

                </a>

                <!-- DELETE -->
                <form action="{{ route('events.destroy', $event->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Delete this event?')"
                            class="px-5 py-3 rounded-xl bg-red-100 text-red-600 font-medium hover:bg-red-200 transition">

                        Delete

                    </button>

                </form>

            </div>

        </div>

        @empty

        <!-- EMPTY STATE -->
        <div class="bg-white rounded-3xl p-20 text-center col-span-2 shadow-sm">

            <div class="text-7xl mb-6">
                📅
            </div>

            <h2 class="text-4xl font-bold text-gray-700">

                No Events Found

            </h2>

            <p class="text-gray-400 mt-4 text-lg">

                Create your first company event

            </p>

            <a href="{{ route('events.create') }}"
               class="inline-block mt-8 bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg transition">

                + Create Event

            </a>

        </div>

        @endforelse

    </div>

</div>

@endsection