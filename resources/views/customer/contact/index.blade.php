@extends('layouts.customer')

@section('title', 'Contact Concierge - Danone Store Indonesia')

@section('content')
<section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mb-12">
        <span class="text-xs uppercase tracking-[0.2em] text-[#7A8B6F] font-semibold block mb-2">Concierge & Sourcing</span>
        <h1 class="font-serif text-3xl sm:text-5xl text-[#1C1C1C]">Get in Touch</h1>
        <p class="text-[#777777] mt-4 leading-relaxed font-light">
            Whether you have questions regarding spring water delivery subscriptions, probiotic dietary guidance, or wholesale plant milk supply for your cafe, our nutrition concierge team is here to assist.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        {{-- Contact Form --}}
        <div class="lg:col-span-7 bg-white p-8 sm:p-10 border border-[#E5E0D8] rounded">
            <h2 class="font-serif text-2xl text-[#1C1C1C] mb-6">Send Us a Message</h2>

            @if(session('success'))
                <div class="mb-6 p-4 bg-[#e8ede6] border border-[#7A8B6F] text-[#5a6e50] text-sm rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded">
                    @foreach($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Your Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Astrid Berg">
                    </div>
                    <div>
                        <label class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Email Address *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="e.g. astrid@example.com">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Subject *</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" required placeholder="e.g. Inquiring about Oslo Oak Dining Table">
                </div>

                <div>
                    <label class="block text-xs font-medium uppercase tracking-wider text-[#333333] mb-1.5">Message *</label>
                    <textarea name="message" rows="5" required placeholder="How may we assist your home design journey?">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn-primary w-full sm:w-auto">
                    Send Message
                </button>
            </form>
        </div>

        {{-- Company Details --}}
        <div class="lg:col-span-5 space-y-8">
            <div class="bg-[#FAF8F3] p-8 border border-[#E5E0D8] rounded space-y-6">
                <div>
                    <h3 class="font-serif text-lg text-[#1C1C1C] mb-2 font-medium">Main Studio & Showroom</h3>
                    <p class="text-sm text-[#777777] leading-relaxed">
                        Kronprinsens Gade 14<br>
                        1114 Copenhagen K, Denmark
                    </p>
                </div>

                <div class="border-t border-[#E5E0D8] pt-4">
                    <h3 class="font-serif text-lg text-[#1C1C1C] mb-2 font-medium">Direct Inquiries</h3>
                    <p class="text-sm text-[#777777] leading-relaxed">
                        Email: <a href="mailto:concierge@danone.co.id" class="text-[#1C1C1C] underline">concierge@danone.co.id</a><br>
                        Phone: +45 33 12 34 56
                    </p>
                </div>

                <div class="border-t border-[#E5E0D8] pt-4">
                    <h3 class="font-serif text-lg text-[#1C1C1C] mb-2 font-medium">Opening Hours</h3>
                    <p class="text-sm text-[#777777] leading-relaxed">
                        Monday – Friday: 10:00 – 18:00<br>
                        Saturday: 10:00 – 16:00<br>
                        Sunday: Private Appointments
                    </p>
                </div>
            </div>

            <div class="p-6 bg-[#F5F2EB] rounded border border-[#E5E0D8] text-xs text-[#777777] space-y-2">
                <p class="font-medium text-[#1C1C1C]">Trade & Architect Enquiries</p>
                <p>We work closely with interior architects and design firms worldwide. Please specify project dimensions and timelines in your message.</p>
            </div>
        </div>
    </div>
</section>
@endsection
