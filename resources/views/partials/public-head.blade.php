<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

@php
    $faviconPath = public_path('laporin.png');
    $faviconVersion = file_exists($faviconPath) ? filemtime($faviconPath) : time();
    $faviconUrl = asset('laporin.png') . '?v=' . $faviconVersion;
@endphp

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="{{ $faviconUrl }}" sizes="32x32" type="image/png">
<link rel="shortcut icon" href="{{ $faviconUrl }}" type="image/png">
<link rel="apple-touch-icon" href="{{ $faviconUrl }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/public.css', 'resources/js/app.js'])

@livewireStyles
