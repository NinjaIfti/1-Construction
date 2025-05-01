@extends('layouts.client.dashboard')

@section('content')
<div class="w-full max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-6">Profile Settings</h2>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-xl font-semibold mb-4">Account Information</h3>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <div class="p-2 bg-gray-100 rounded">{{ $user->name }}</div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <div class="p-2 bg-gray-100 rounded">{{ $user->email }}</div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Company</label>
            <div class="p-2 bg-gray-100 rounded">{{ $user->company_name }}</div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Verification Status</label>
            <div class="p-2 {{ $user->verification_status === 'approved' ? 'bg-green-100 text-green-700' : ($user->verification_status === 'under_review' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }} rounded font-semibold">
                {{ $user->getVerificationStatusLabel() }}
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-semibold mb-4">Change Password</h3>
        <form method="POST" action="{{ route('profile.update-password') }}">
            @csrf
            
            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
                <input id="current_password" type="password" name="current_password" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('current_password') border-red-500 @enderror">
                @error('current_password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <input id="password" type="password" name="password" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 