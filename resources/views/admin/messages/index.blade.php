@extends('layouts.admin')

@section('title', 'Concierge & Inquiries - Nordic Operations')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Client Relations &bull; Concierge Communications Desk
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Concierge & Client Inquiries</h1>
            <p class="text-xs text-[#71717A] mt-1">Review, respond to, and archive messages received from website visitors.</p>
        </div>
        <div>
            <span class="text-xs font-mono text-[#71717A]">{{ $messages->total() }} Recorded Inquiries</span>
        </div>
    </div>

    {{-- Table Container --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden shadow-xs">
        <table class="w-full text-left text-xs">
            <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider text-[10px] border-b border-[#E8E4DC]">
                <tr>
                    <th class="py-3.5 px-6 font-semibold">Sender</th>
                    <th class="py-3.5 px-6 font-semibold">Subject</th>
                    <th class="py-3.5 px-6 font-semibold">Timestamp</th>
                    <th class="py-3.5 px-6 font-semibold">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E8E4DC]">
                @forelse($messages as $m)
                    <tr class="{{ !$m->is_read ? 'bg-[#FAF8F3]/70 font-semibold' : 'hover:bg-[#FAF8F3]/50 transition-colors' }}">
                        <td class="py-4 px-6 text-[#18181A]">
                            {{ $m->name }} 
                            <span class="text-[10px] text-[#71717A] block font-normal">{{ $m->email }}</span>
                        </td>
                        <td class="py-4 px-6 text-[#27272A]">{{ $m->subject }}</td>
                        <td class="py-4 px-6 text-[#71717A] font-normal">{{ $m->created_at->format('M d, Y H:i') }}</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold {{ $m->is_read ? 'bg-[#FAF8F3] text-[#71717A]' : 'bg-[#FFF8EB] text-[#8A6112]' }}">
                                {{ $m->is_read ? 'Read' : 'Unread' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-3 font-normal">
                            <a href="{{ route('admin.messages.show', $m->id) }}" class="text-[#18181A] hover:text-[#7A8B6F] font-semibold underline">Inspect</a>
                            <form action="{{ route('admin.messages.destroy', $m->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-8 text-center text-[#71717A]">Inquiry inbox is clear.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($messages->hasPages())
            <div class="p-4 border-t border-[#E8E4DC] bg-[#FAF8F3]">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
