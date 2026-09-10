@extends('layouts.admin')

@section('title', 'Consumer Reviews Moderation - Nordic Operations')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Customer Voices &bull; Feedback Moderation Ledger
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Consumer Reviews Moderation</h1>
            <p class="text-xs text-[#71717A] mt-1">Review, approve, and curate feedback submitted by verified customers.</p>
        </div>
        <div>
            <span class="text-xs font-mono text-[#71717A]">{{ $reviews->total() }} Total Reviews</span>
        </div>
    </div>

    {{-- Table Container --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden shadow-xs">
        <table class="w-full text-left text-xs">
            <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider text-[10px] border-b border-[#E8E4DC]">
                <tr>
                    <th class="py-3.5 px-6 font-semibold">Product</th>
                    <th class="py-3.5 px-6 font-semibold">Customer</th>
                    <th class="py-3.5 px-6 font-semibold">Rating</th>
                    <th class="py-3.5 px-6 font-semibold">Comment</th>
                    <th class="py-3.5 px-6 font-semibold">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E8E4DC]">
                @forelse($reviews as $r)
                    <tr class="hover:bg-[#FAF8F3]/50 transition-colors">
                        <td class="py-4 px-6 font-medium text-[#18181A]">{{ $r->product->name }}</td>
                        <td class="py-4 px-6 text-[#71717A]">{{ $r->user->name ?? 'Customer' }}</td>
                        <td class="py-4 px-6 text-amber-500 font-medium">★ {{ $r->rating }}/5</td>
                        <td class="py-4 px-6 text-[#52525B] max-w-xs truncate">{{ $r->comment }}</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold {{ $r->is_approved ? 'bg-[#F0F4EE] text-[#4A6342]' : 'bg-[#FFF8EB] text-[#8A6112]' }}">
                                {{ $r->is_approved ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-3">
                            @if(!$r->is_approved)
                                <form action="{{ route('admin.reviews.approve', $r->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-[#18181A] hover:text-[#7A8B6F] font-semibold underline">Approve</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.reviews.destroy', $r->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete review?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-600 hover:text-rose-800 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="p-8 text-center text-[#71717A]">No customer reviews recorded.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($reviews->hasPages())
            <div class="p-4 border-t border-[#E8E4DC] bg-[#FAF8F3]">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
