{{-- resources/views/components/badge.blade.php --}}
@props([
    'status' => 'draft',
])
@php
    $config = match ($status) {
        'published' => ['class' => 'bg-success', 'label' => '✅ Đã xuất bản'],
        'draft' => ['class' => 'bg-secondary', 'label' => '📝 Bản nháp'],
        'archive', 'archived' => ['class' => 'bg-warning', 'label' => '📦 Lưu trữ'],
        default => ['class' => 'bg-secondary', 'label' => '❓ ' . $status],
    };
@endphp

{{-- Render thẻ HTML badge hoàn chỉnh --}}
<span class="badge {{ $config['class'] }}">
    {{ $config['label'] }}
</span>