@extends('layouts.admin')

@section('title', 'Message: ' . $message->subject . ' - Nordic Admin')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center justify-between border-b border-[#E5E0D8] pb-4">
        <div>
            <span class="text-xs uppercase tracking-wider text-[#777777]">Message Detail</span>
            <h1 class="font-serif text-2xl text-[#1C1C1C]">{{ $message->subject }}</h1>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="text-xs text-[#777777] hover:underline">&larr; Back to Inbox</a>
    </div>

    <div class="bg-white border border-[#E5E0D8] rounded p-6 space-y-6">
        <div class="flex justify-between items-center border-b border-[#E5E0D8] pb-4 text-xs">
            <div>
                <p class="font-medium text-[#1C1C1C]">{{ $message->name }} &lt;{{ $message->email }}&gt;</p>
                <p class="text-[#777777]">Received on {{ $message->created_at->format('F d, Y \a\t H:i') }}</p>
            </div>
            <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject) }}" class="btn-primary py-1.5 px-3 text-xs">Reply via Email</a>
        </div>

        <div class="text-sm text-[#333333] leading-relaxed whitespace-pre-wrap">
            {{ $message->message }}
        </div>
    </div>
</div>
@endsection
