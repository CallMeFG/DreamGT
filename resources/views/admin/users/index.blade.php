@extends('layouts.app')

@section('content')
    <div class="min-h-full bg-gray-50 w-full p-8 md:p-12">

        <div class="flex flex-col md:flex-row justify-between items-end gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-ewc-black uppercase tracking-tighter">Manage Users</h1>
                <p class="text-sm text-gray-500 mt-1">Total Registered: {{ $users->total() }} Accounts</p>
            </div>
        </div>

        <div
            class="bg-white p-4 rounded-t-xl border border-gray-200 border-b-0 flex flex-col md:flex-row justify-between gap-4 shadow-sm">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-3 w-full md:w-auto items-center">

                <div class="relative">
                    <select name="role" onchange="this.form.submit()"
                        class="appearance-none bg-gray-50 border border-gray-300 text-gray-700 text-xs font-bold uppercase rounded-sm py-2.5 pl-4 pr-8 focus:outline-none focus:border-ewc-gold cursor-pointer">
                        <option value="all">All Roles</option>
                        <option value="member" {{ request('role') == 'member' ? 'selected' : '' }}>Member</option>
                        <option value="staff_pc" {{ request('role') == 'staff_pc' ? 'selected' : '' }}>Staff PC</option>
                        <option value="staff_arena" {{ request('role') == 'staff_arena' ? 'selected' : '' }}>Staff Arena
                        </option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <div class="relative w-full md:w-64">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Name / Email / Username..."
                        class="w-full pl-9 pr-4 py-2.5 text-xs border border-gray-300 rounded-sm focus:border-ewc-gold focus:ring-1 focus:ring-ewc-gold outline-none transition-all">
                    <svg class="w-4 h-4 text-gray-400 absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <button type="submit"
                    class="px-4 py-2.5 bg-gray-100 text-gray-600 text-xs font-bold uppercase rounded-sm hover:bg-gray-200 transition">Filter</button>

                @if(request('search') || request('role'))
                    <a href="{{ route('admin.users.index') }}" class="text-red-500 text-xs font-bold hover:underline">Reset</a>
                @endif
            </form>
        </div>

        <div class="bg-white border border-gray-200 rounded-b-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-500 font-bold uppercase text-xs border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4">User Profile</th>
                            <th class="px-6 py-4">Contact Info</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Joined Date</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-ewc-black flex items-center justify-center text-ewc-gold font-bold text-sm shadow-sm border border-gray-200">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-bold text-gray-800">{{ $user->name }}</p>
                                                        <p class="text-xs text-gray-400">@ {{ $user->username }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-xs font-bold text-gray-600">{{ $user->email }}</p>
                                                <p class="text-[10px] text-gray-400">{{ $user->phone ?? 'No Phone' }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide
                                                        {{ $user->role == 'admin' ? 'bg-red-100 text-red-700' :
                            ($user->role == 'member' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700') }}">
                                                    {{ $user->role }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-xs text-gray-500">
                                                {{ $user->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                @if(Auth::id() !== $user->id)
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to remove {{ $user->name }}? This action is irreversible.');">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors"
                                                            title="Delete User">
                                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-[10px] text-gray-300 italic">You</span>
                                                @endif
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400">No users found matching your criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100 bg-gray-50">
                {{ $users->links('pagination.custom') }}
            </div>
        </div>
    </div>
@endsection