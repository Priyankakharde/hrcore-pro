@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- ================================= -->
    <!-- PAGE HEADER -->
    <!-- ================================= -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">

                My Profile

            </h1>

            <p class="text-gray-500 mt-2">

                Manage your account and personal information.

            </p>

        </div>

    </div>

    @if(session('status')=='profile-updated')

        <div class="bg-green-100 border border-green-300 text-green-700 rounded-xl p-4 mb-6">

            Profile updated successfully.

        </div>

    @endif

    <form method="POST"
          action="{{ route('profile.update') }}"
          enctype="multipart/form-data">

        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- ================================= -->
            <!-- PROFILE CARD -->
            <!-- ================================= -->

            <div class="bg-white rounded-2xl shadow-sm p-8 text-center">

                <img
                    src="{{ $user->profile_photo_url }}"
                    class="w-40 h-40 rounded-full mx-auto object-cover border-4 border-blue-500">

                <h2 class="text-2xl font-bold mt-6">

                    {{ $user->name }}

                </h2>

                <p class="text-gray-500">

                    {{ $user->designation ?? 'HR Employee' }}

                </p>

                <div class="mt-6">

                    <label class="block font-semibold mb-2">

                        Profile Photo

                    </label>

                    <input
                        type="file"
                        name="profile_photo"
                        class="w-full border rounded-xl p-3">

                </div>

            </div>

            <!-- ================================= -->
            <!-- PERSONAL INFORMATION -->
            <!-- ================================= -->

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-8">

                <h2 class="text-2xl font-bold mb-6">

                    Personal Information

                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Name -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Full Name

                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name',$user->name) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Email -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email',$user->email) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Phone -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Phone

                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone',$user->phone) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Department -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Department

                        </label>

                        <input
                            type="text"
                            name="department"
                            value="{{ old('department',$user->department) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>
                                        <!-- Designation -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Designation

                        </label>

                        <input
                            type="text"
                            name="designation"
                            value="{{ old('designation', $user->designation) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Date of Birth -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Date of Birth

                        </label>

                        <input
                            type="date"
                            name="dob"
                            value="{{ old('dob', optional($user->dob)->format('Y-m-d')) }}"
                            class="w-full border rounded-xl px-4 py-3">

                    </div>

                    <!-- Gender -->

                    <div>

                        <label class="block mb-2 font-semibold">

                            Gender

                        </label>

                        <select
                            name="gender"
                            class="w-full border rounded-xl px-4 py-3">

                            <option value="">Select Gender</option>

                            <option value="Male"
                                {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="Female"
                                {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>

                            <option value="Other"
                                {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                    </div>

                    <!-- Address -->

                    <div class="md:col-span-2">

                        <label class="block mb-2 font-semibold">

                            Address

                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            class="w-full border rounded-xl px-4 py-3">{{ old('address', $user->address) }}</textarea>

                    </div>

                    <!-- Bio -->

                    <div class="md:col-span-2">

                        <label class="block mb-2 font-semibold">

                            Bio

                        </label>

                        <textarea
                            name="bio"
                            rows="5"
                            class="w-full border rounded-xl px-4 py-3">{{ old('bio', $user->bio) }}</textarea>

                    </div>

                </div>

                <!-- Buttons -->

                <div class="flex justify-end gap-4 mt-8">

                    <a href="{{ route('dashboard') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl">

                        Save Changes

                    </button>

                </div>

            </div>

        </div>

    </form>
        <!-- ================================= -->
    <!-- CHANGE PASSWORD -->
    <!-- ================================= -->

    <div class="bg-white rounded-2xl shadow-sm p-8 mt-8">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">

            Change Password

        </h2>

        <p class="text-gray-500 mb-6">

            For security reasons, you can change your password below.

        </p>

        @include('profile.partials.update-password-form')

    </div>

    <!-- ================================= -->
    <!-- DELETE ACCOUNT -->
    <!-- ================================= -->

    <div class="bg-white rounded-2xl shadow-sm p-8 mt-8 border border-red-200">

        <h2 class="text-2xl font-bold text-red-600 mb-6">

            Delete Account

        </h2>

        <p class="text-gray-500 mb-6">

            Once your account is deleted, all of your data will be permanently removed. This action cannot be undone.

        </p>

        @include('profile.partials.delete-user-form')

    </div>

</div>

@endsection