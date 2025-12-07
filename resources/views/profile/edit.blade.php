@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-6">
        <div class="max-w-7xl mx-auto">

            <div class="mb-8">
                <h1 class="text-3xl font-black text-ewc-black uppercase tracking-tighter">Account Settings</h1>
                <p class="text-sm text-gray-500">Manage your profile information and security.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-8">
                    <div class="p-8 bg-white border border-gray-200 rounded-xl shadow-sm">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="p-8 bg-red-50 border border-red-100 rounded-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="p-8 bg-white border border-gray-200 rounded-xl shadow-sm h-full">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection