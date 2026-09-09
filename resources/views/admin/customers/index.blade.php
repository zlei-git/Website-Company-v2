@extends('layouts.admin')

@section('title', 'Private Collectors & Clients - NordicHome Atelier')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-[#E8E4DC] pb-6 gap-4">
        <div>
            <div class="text-[10px] uppercase tracking-[0.25em] text-[#71717A] font-semibold mb-1">
                Client Directory &bull; {{ $customers->total() }} Registered Collectors
            </div>
            <h1 class="font-serif text-3xl text-[#18181A] font-normal">Private Collectors</h1>
            <p class="text-xs text-[#71717A] mt-1">Client accounts, acquisition histories, and bespoke interior relationships.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary text-xs py-2 px-4">
                &larr; Studio Overview
            </a>
        </div>
    </div>

    {{-- Customers Table --}}
    <div class="bg-white border border-[#E8E4DC] rounded-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-[#FAF8F3] text-[#71717A] uppercase tracking-wider border-b border-[#E8E4DC]">
                    <tr>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Collector Name</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Direct Contact</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Commissions</th>
                        <th class="py-3.5 px-6 font-medium text-[10px]">Registry Date</th>
                        <th class="py-3.5 px-6 font-medium text-[10px] text-right">Dossier</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E8E4DC]">
                    @forelse($customers as $c)
                        <tr class="hover:bg-[#FAF8F3]/50 transition-colors">
                            <td class="py-4 px-6 flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-full bg-[#FAF8F3] border border-[#E8E4DC] flex items-center justify-center font-serif text-xs font-medium text-[#18181A]">
                                    {{ strtoupper(substr($c->name, 0, 1)) }}
                                </div>
                                <div>
                                    <span class="font-medium text-[#18181A] block">{{ $c->name }}</span>
                                    <span class="text-[10px] text-[#71717A] block">ID: #C{{ str_pad($c->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="text-xs text-[#18181A] block">{{ $c->email }}</span>
                                <span class="text-[10px] text-[#71717A] block mt-0.5">{{ $c->phone ?? 'No phone recorded' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center space-x-1 px-2.5 py-1 bg-[#FAF8F3] border border-[#E8E4DC] rounded-xs font-mono text-[11px] text-[#18181A]">
                                    <span>{{ $c->orders->count() }}</span>
                                    <span class="text-[#71717A] text-[10px]">{{ Str::plural('piece', $c->orders->count()) }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-[#71717A]">
                                {{ $c->created_at->format('d M Y') }}
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.customers.show', $c->id) }}" class="inline-flex items-center space-x-1 text-xs font-medium text-[#18181A] hover:text-[#7A8B6F] transition-colors">
                                    <span>View Dossier</span>
                                    <span class="text-[10px]">&rarr;</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-xs text-[#71717A]">
                                No collector profiles registered in the atelier directory yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($customers->hasPages())
            <div class="p-4 border-t border-[#E8E4DC] bg-[#FAF8F3]">
                {{ $customers->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
