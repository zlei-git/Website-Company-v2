@props([
    'type' => 'neutral', // success, warning, danger, info, neutral, charcoal, wood
    'size' => 'md',      // sm, md
    'dot' => false,
])

@php
    $baseStyles = 'inline-flex items-center font-medium uppercase tracking-wider rounded-sm transition-colors duration-150';
    
    $sizes = [
        'sm' => 'px-2 py-0.5 text-[10px] gap-1',
        'md' => 'px-2.5 py-1 text-[11px] gap-1.5',
    ];
    
    $types = [
        'success' => 'bg-[#e8ede6] text-[#4a5e42] border border-[#d3dfce]',
        'warning' => 'bg-[#faf0df] text-[#8a631c] border border-[#f2dfb8]',
        'danger'  => 'bg-[#fbe9e7] text-[#9b3a2b] border border-[#f5c7c1]',
        'info'    => 'bg-[#edf3f8] text-[#355b7d] border border-[#d2e2f0]',
        'neutral' => 'bg-[#f0ebe1] text-[#555555] border border-[#e5e0d8]',
        'charcoal'=> 'bg-[#1C1C1C] text-[#FAF8F3] border border-[#1C1C1C]',
        'wood'    => 'bg-[#D8C3A5]/25 text-[#6d573d] border border-[#D8C3A5]/50',
    ];

    $dotColors = [
        'success' => 'bg-[#4a5e42]',
        'warning' => 'bg-[#8a631c]',
        'danger'  => 'bg-[#9b3a2b]',
        'info'    => 'bg-[#355b7d]',
        'neutral' => 'bg-[#777777]',
        'charcoal'=> 'bg-[#FAF8F3]',
        'wood'    => 'bg-[#6d573d]',
    ];

    $badgeClass = ($sizes[$size] ?? $sizes['md']) . ' ' . ($types[$type] ?? $types['neutral']);
    $dotClass = $dotColors[$type] ?? $dotColors['neutral'];
@endphp

<span {{ $attributes->merge(['class' => "$baseStyles $badgeClass"]) }}>
    @if($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotClass }}"></span>
    @endif
    {{ $slot }}
</span>
