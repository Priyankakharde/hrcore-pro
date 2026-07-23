@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Create Event
            </h1>

            <p class="text-gray-500 mt-2">
                Add new company event
            </p>

        </div>

        <a href="{{ route('events.index') }}"
           class="px-6 py-4 bg-gray-100 rounded-2xl font-semibold hover:bg-gray-200 transition">

            Back

        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">

        <form action="{{ route('events.store') }}"
              method="POST"
              class="space-y-8">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- EVENT TITLE -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Event Title
                    </label>

                    <input type="text"
                           name="title"
                           placeholder="Annual Company Meeting"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- EVENT TYPE -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Event Type
                    </label>

                    <select name="event_type"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                        <option>Meeting</option>

                        <option>Training</option>

                        <option>Workshop</option>

                        <option>Conference</option>

                        <option>Holiday</option>

                        <option>Birthday</option>

                        <option>Team Activity</option>

                    </select>

                </div>

                <!-- ORGANIZER -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Organizer
                    </label>

                    <input type="text"
                           name="organizer"
                           placeholder="HR Department"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- LOCATION -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Location
                    </label>

                    <input type="text"
                           name="location"
                           placeholder="Conference Hall"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- EVENT DATE -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Event Date
                    </label>

                    <input type="date"
                           name="event_date"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- PRIORITY -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Priority
                    </label>

                    <select name="priority"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                        <option>Low</option>

                        <option>Medium</option>

                        <option>High</option>

                    </select>

                </div>

                <!-- START TIME -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Start Time
                    </label>

                    <input type="time"
                           name="start_time"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- END TIME -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        End Time
                    </label>

                    <input type="time"
                           name="end_time"
                           class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <!-- STATUS -->
                <div>

                    <label class="block text-gray-700 font-medium mb-3">
                        Status
                    </label>

                    <select name="status"
                            class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none">

                        <option>Upcoming</option>

                        <option>Ongoing</option>

                        <option>Completed</option>

                        <option>Cancelled</option>

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
                          placeholder="Write event details..."
                          class="w-full rounded-2xl border border-gray-200 px-5 py-4 focus:ring-2 focus:ring-blue-500 outline-none"></textarea>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg transition">

                Save Event

            </button>

        </form>

    </div>

</div>

@endsection