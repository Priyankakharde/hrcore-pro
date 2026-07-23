@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-3xl p-10 shadow-sm">

        <div class="flex justify-between items-start">

            <div>

                <div class="flex gap-3 mb-5">

                    <span class="px-4 py-2 rounded-full bg-blue-100 text-blue-600 font-medium">
                        {{ $event->event_type }}
                    </span>

                    <span class="px-4 py-2 rounded-full bg-purple-100 text-purple-600 font-medium">
                        {{ $event->priority }}
                    </span>

                </div>

                <h1 class="text-5xl font-bold text-gray-800">
                    {{ $event->title }}
                </h1>

            </div>

            <span class="px-5 py-3 rounded-full bg-green-100 text-green-600 font-semibold">
                {{ $event->status }}
            </span>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">

            <div class="bg-gray-50 rounded-2xl p-6">

                <p class="text-gray-400 mb-2">Organizer</p>

                <h2 class="text-2xl font-bold">
                    {{ $event->organizer }}
                </h2>

            </div>

            <div class="bg-gray-50 rounded-2xl p-6">

                <p class="text-gray-400 mb-2">Location</p>

                <h2 class="text-2xl font-bold">
                    {{ $event->location }}
                </h2>

            </div>

            <div class="bg-gray-50 rounded-2xl p-6">

                <p class="text-gray-400 mb-2">Date</p>

                <h2 class="text-2xl font-bold">
                    {{ $event->event_date }}
                </h2>

            </div>

            <div class="bg-gray-50 rounded-2xl p-6">

                <p class="text-gray-400 mb-2">Time</p>

                <h2 class="text-2xl font-bold">
                    {{ $event->start_time }} - {{ $event->end_time }}
                </h2>

            </div>

        </div>

        <div class="mt-10">

            <h2 class="text-3xl font-bold text-gray-800 mb-5">
                Event Description
            </h2>

            <p class="text-gray-500 leading-relaxed text-lg">
                {{ $event->description }}
            </p>

        </div>

        <div class="flex gap-4 mt-10">

            <a href="{{ route('events.edit', $event->id) }}"
               class="px-8 py-4 rounded-2xl bg-purple-100 text-purple-600 font-semibold">

                Edit Event

            </a>

            <a href="{{ route('events.index') }}"
               class="px-8 py-4 rounded-2xl bg-gray-100 text-gray-700 font-semibold">

                Back

            </a>

        </div>

    </div>

</div>

@endsection