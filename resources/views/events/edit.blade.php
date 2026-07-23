@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Edit Event
            </h1>

            <p class="text-gray-500 mt-2">
                Update company event details
            </p>

        </div>

        <a href="{{ route('events.index') }}"
           class="px-6 py-4 bg-gray-100 rounded-2xl font-semibold hover:bg-gray-200 transition">

            Back

        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">

        <form action="{{ route('events.update', $event->id) }}"
              method="POST"
              class="space-y-8">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- EVENT TITLE -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Event Title
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ $event->title }}"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- EVENT TYPE -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Event Type
                    </label>

                    <select name="event_type"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                        <option {{ $event->event_type == 'Meeting' ? 'selected' : '' }}>Meeting</option>

                        <option {{ $event->event_type == 'Training' ? 'selected' : '' }}>Training</option>

                        <option {{ $event->event_type == 'Workshop' ? 'selected' : '' }}>Workshop</option>

                        <option {{ $event->event_type == 'Conference' ? 'selected' : '' }}>Conference</option>

                        <option {{ $event->event_type == 'Holiday' ? 'selected' : '' }}>Holiday</option>

                        <option {{ $event->event_type == 'Birthday' ? 'selected' : '' }}>Birthday</option>

                        <option {{ $event->event_type == 'Team Activity' ? 'selected' : '' }}>Team Activity</option>

                    </select>

                </div>

                <!-- ORGANIZER -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Organizer
                    </label>

                    <input type="text"
                           name="organizer"
                           value="{{ $event->organizer }}"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- LOCATION -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Location
                    </label>

                    <input type="text"
                           name="location"
                           value="{{ $event->location }}"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- EVENT DATE -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Event Date
                    </label>

                    <input type="date"
                           name="event_date"
                           value="{{ $event->event_date }}"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- PRIORITY -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Priority
                    </label>

                    <select name="priority"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                        <option {{ $event->priority == 'Low' ? 'selected' : '' }}>Low</option>

                        <option {{ $event->priority == 'Medium' ? 'selected' : '' }}>Medium</option>

                        <option {{ $event->priority == 'High' ? 'selected' : '' }}>High</option>

                    </select>

                </div>

                <!-- START TIME -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Start Time
                    </label>

                    <input type="time"
                           name="start_time"
                           value="{{ $event->start_time }}"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- END TIME -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        End Time
                    </label>

                    <input type="time"
                           name="end_time"
                           value="{{ $event->end_time }}"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- STATUS -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Status
                    </label>

                    <select name="status"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                        <option {{ $event->status == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>

                        <option {{ $event->status == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>

                        <option {{ $event->status == 'Completed' ? 'selected' : '' }}>Completed</option>

                        <option {{ $event->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>

                    </select>

                </div>

            </div>

            <!-- DESCRIPTION -->
            <div>

                <label class="block text-gray-700 font-medium mb-3">
                    Event Description
                </label>

                <textarea name="description"
                          rows="6"
                          class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">{{ $event->description }}</textarea>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg transition">

                Update Event

            </button>

        </form>

    </div>

</div>

@endsection