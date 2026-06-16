{{-- SUCCESS --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" style="border-left: 4px solid #16a34a;" role="alert">
        <div class="d-flex align-items-center gap-2">
            <strong>Thành công!</strong>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ERROR --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" style="border-left: 4px solid #dc2626;" role="alert">
        <div class="d-flex align-items-center gap-2">
            <strong>Lỗi!</strong>
            <div>{{ session('error') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- WARNING --}}
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" style="border-left: 4px solid #d97706;" role="alert">
        <div class="d-flex align-items-center gap-2">
            <strong>Chú ý!</strong>
            <div>{{ session('warning') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- INFO --}}
@if (session('info'))
    <div class="alert alert-info alert-dismissible fade show" style="border-left: 4px solid #0891b2;" role="alert">
        <div class="d-flex align-items-center gap-2">
            <strong>Thông báo:</strong>
            <div>{{ session('info') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif