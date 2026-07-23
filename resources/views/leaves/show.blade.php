@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto space-y-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-5xl font-bold text-gray-800">
                Leave Details
            </h1>

            <p class="text-gray-500 mt-2">
                Employee leave request full information
            </p>

        </div>

        <!-- BACK -->
        <a href="{{ route('leaves.index') }}"
           class="bg-gray-100 hover:bg-gray-200 px-6 py-3 rounded-2xl font-semibold">

            Back

        </a>

    </div>

    <!-- MAIN CARD -->
    <div class="bg-white rounded-3xl p-10 shadow-sm border border-gray-100">

        <!-- TOP -->
        <div class="flex flex-col xl:flex-row xl:justify-between xl:items-start gap-8">

            <div>

                <!-- BADGES -->
                <div class="flex flex-wrap gap-3 mb-5">

                    <!-- LEAVE TYPE -->
                    <span class="px-5 py-2 rounded-full bg-blue-100 text-blue-600 text-sm font-semibold">

                        {{ $leave->leave_type }}

                    </span>

                    <!-- PRIORITY -->
                    @if($leave->priority == 'High')

                        <span class="px-5 py-2 rounded-full bg-red-100 text-red-600 text-sm font-semibold">

                            High

                        </span>

                    @elseif($leave->priority == 'Medium')

                        <span class="px-5 py-2 rounded-full bg-yellow-100 text-yellow-600 text-sm font-semibold">

                            Medium

                        </span>

                    @else

                        <span class="px-5 py-2 rounded-full bg-green-100 text-green-600 text-sm font-semibold">

                            Low

                        </span>

                    @endif

                    <!-- STATUS -->
                    @if($leave->status == 'Approved')

                        <span class="px-5 py-2 rounded-full bg-green-100 text-green-600 text-sm font-semibold">

                            Approved

                        </span>

                    @elseif($leave->status == 'Rejected')

                        <span class="px-5 py-2 rounded-full bg-red-100 text-red-600 text-sm font-semibold">

                            Rejected

                        </span>

                    @else

                        <span class="px-5 py-2 rounded-full bg-yellow-100 text-yellow-600 text-sm font-semibold">

                            Pending

                        </span>

                    @endif

                </div>

                <!-- NAME -->
                <h2 class="text-5xl font-bold text-gray-800">

                    {{ $leave->employee_name }}

                </h2>

                <p class="text-gray-400 mt-3 text-lg">

                    Employee ID: {{ $leave->employee_id }}

                </p>

            </div>

                                        
  
            
        <!-- REASON -->
        <div class="mt-12">

            <h3 class="text-3xl font-bold text-gray-800 mb-5">
                Leave Reason
            </h3>

            <div class="bg-gray-50 rounded-3xl p-8">

                <p class="text-gray-600 leading-relaxed text-lg">

                    {{ $leave->reason }}

                </p>

            </div>

        </div>

        <!-- ADMIN NOTE -->
        <div class="mt-10">

            <h3 class="text-3xl font-bold text-gray-800 mb-5">
                Admin Note
            </h3>

            <div class="bg-yellow-50 rounded-3xl p-8 border border-yellow-100">

                <p class="text-gray-700 leading-relaxed text-lg">

                    {{ $leave->admin_note ?? 'No admin note added.' }}

                </p>

            </div>

        </div>

        <!-- APPLIED DATE -->
        <div class="mt-10 bg-gray-50 rounded-3xl p-6">

            <p class="text-gray-400 mb-2">
                Applied Date
            </p>

            <h3 class="text-2xl font-bold text-gray-800">

                {{ $leave->applied_date }}

            </h3>

        </div>

    </div>

</div>

@endsection