@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- Header -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">

                Notification Details

            </h1>

            <p class="text-gray-500 mt-2">

                View complete notification information.

            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('notifications.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-xl">

                ← Back

            </a>

            <a href="{{ route('notifications.edit',$notification) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

                Edit

            </a>

        </div>

    </div>

    <!-- Notification Card -->

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Employee -->

            <div>

                <h3 class="text-gray-500 mb-2">

                    Employee

                </h3>

                <p class="text-xl font-semibold">

                    {{ $notification->user->name }}

                </p>

            </div>

            <!-- Title -->

            <div>

                <h3 class="text-gray-500 mb-2">

                    Title

                </h3>

                <p class="text-xl font-semibold">

                    {{ $notification->title }}

                </p>

            </div>

            <!-- Type -->

            <div>

                <h3 class="text-gray-500 mb-2">

                    Type

                </h3>

                <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">

                    {{ $notification->type }}

                </span>

            </div>

            <!-- Priority -->

            <div>

                <h3 class="text-gray-500 mb-2">

                    Priority

                </h3>

                @if($notification->priority=='High')

                    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">

                        High

                    </span>

                @elseif($notification->priority=='Medium')

                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">

                        Medium

                    </span>

                @else

                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                        Low

                    </span>

                @endif

            </div>
                        <!-- Status -->

            <div>

                <h3 class="text-gray-500 mb-2">

                    Status

                </h3>

                @if($notification->status=='Read')

                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                        Read

                    </span>

                @else

                    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">

                        Unread

                    </span>

                @endif

            </div>

            <!-- Created Date -->

            <div>

                <h3 class="text-gray-500 mb-2">

                    Created On

                </h3>

                <p>

                    {{ $notification->created_at->format('d M Y h:i A') }}

                </p>

            </div>

            <!-- Message -->

            <div class="md:col-span-2">

                <h3 class="text-gray-500 mb-2">

                    Message

                </h3>

                <div class="bg-gray-50 rounded-xl p-5 border">

                    {{ $notification->message }}

                </div>

            </div>

            <!-- Action URL -->

            <div class="md:col-span-2">

                <h3 class="text-gray-500 mb-2">

                    Action URL

                </h3>

                @if($notification->action_url)

                    <a href="{{ url($notification->action_url) }}"
                       class="text-blue-600 hover:underline">

                        {{ url($notification->action_url) }}

                    </a>

                @else

                    <span class="text-gray-500">

                        No Action URL

                    </span>

                @endif

            </div>

        </div>

        <!-- Bottom Buttons -->

        <div class="flex justify-end gap-4 mt-10">

            <a href="{{ route('notifications.edit',$notification) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-xl">

                Edit

            </a>

            <form action="{{ route('notifications.destroy',$notification) }}"
                  method="POST">

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('Delete this notification?')"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl">

                    Delete

                </button>

            </form>

        </div>

    </div>

</div>

@endsection