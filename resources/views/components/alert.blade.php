{{-- resources/views/components/alert.blade.php --}}
@props([
    'type' => 'info',
    'dismissible' => false,
])
@php
    $colorClass = match ($type) {
        'success' => 'alert-success',
        'warning' => 'alert-warning',
        'danger' => 'alert-danger',
        default => 'alert-info',
    };  
@endphp 
    
<div class="alert {{ $colorClass }} {{ $dismissible ? 'alert-dismissible fade show' : '' }}" role="alert">
    {{-- Named slot: $title – chỉ render ra giao diện nếu phía gọi truyền thẻ <x-slot:title> vào --}}
        @if (isset($title) && $title->isNotEmpty())
            <h4 class="alert-heading">{{ $title }}</h4>
            <hr>
        @endif
         {{ $slot }}
         
    @if ($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif

</div>