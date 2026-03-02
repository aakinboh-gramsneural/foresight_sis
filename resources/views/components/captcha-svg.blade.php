@php
    $chars = str_split($question);
    $width = 200;
    $height = 56;
@endphp
<svg xmlns="http://www.w3.org/2000/svg" width="{{ $width }}" height="{{ $height }}" viewBox="0 0 {{ $width }} {{ $height }}">
    <rect width="{{ $width }}" height="{{ $height }}" fill="#f9fafb" rx="8"/>
    {{-- Noise lines --}}
    @for($i = 0; $i < 5; $i++)
        <line x1="{{ rand(0, $width) }}" y1="{{ rand(0, $height) }}" x2="{{ rand(0, $width) }}" y2="{{ rand(0, $height) }}" stroke="#d1d5db" stroke-width="1" opacity="0.6"/>
    @endfor
    {{-- Dots --}}
    @for($i = 0; $i < 20; $i++)
        <circle cx="{{ rand(0, $width) }}" cy="{{ rand(0, $height) }}" r="{{ rand(1, 2) }}" fill="#9ca3af" opacity="0.3"/>
    @endfor
    {{-- Characters with slight random offsets --}}
    @foreach($chars as $index => $char)
        @php
            $x = 20 + ($index * 18);
            $y = 34 + rand(-3, 3);
            $rotate = rand(-8, 8);
            $color = ['#0a1628', '#1d3a6b', '#c8a960'][rand(0, 2)];
        @endphp
        <text x="{{ $x }}" y="{{ $y }}" font-family="monospace" font-size="{{ rand(20, 24) }}" font-weight="bold" fill="{{ $color }}" transform="rotate({{ $rotate }}, {{ $x }}, {{ $y }})">{{ $char }}</text>
    @endforeach
</svg>
