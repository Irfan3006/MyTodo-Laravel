@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="row align-items-center min-vh-75 g-5">
    <div class="col-lg-6 text-center text-lg-start">
        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold mb-3">Produktivitas Tanpa Batas</span>
        <h1 class="display-3 fw-bold mb-4" style="line-height: 1.1;">Siap Untuk <span class="text-primary">Lebih Produktif</span> Hari Ini?</h1>
        <p class="lead text-secondary mb-5 fs-4">Kelola daftar tugas Anda dengan pengalaman modern, cepat, dan responsif. Didesain untuk membantu Anda tetap teratur kapan saja, di mana saja.</p>
        
        <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow-lg">
                    Mulai Sekarang <i class="fas fa-arrow-right ms-2 small"></i>
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">Login</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow-lg">Dashboard</a>
                <a href="{{ route('todos.index') }}" class="btn btn-outline-primary btn-lg px-5 py-3 fw-bold">Tugas Saya</a>
            @endguest
        </div>
        
        <div class="mt-5 pt-4 d-none d-md-block">
            <div class="d-flex align-items-center gap-4 text-secondary small fw-medium">
                <div class="d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i> Gratis Selamanya</div>
                <div class="d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i> Dark Mode Siap</div>
                <div class="d-flex align-items-center"><i class="fas fa-check-circle text-success me-2"></i> Multi-Perangkat</div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="position-relative">
            <div class="bg-primary-subtle rounded-5 p-4 p-md-5 float-animation">
                <div class="card border-0 shadow-lg p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Tugas Terdekat</h5>
                        <i class="fas fa-ellipsis-h text-muted"></i>
                    </div>
                    
                    <div class="todo-item-mock d-flex align-items-center p-3 rounded-4 mb-3" style="background: rgba(13, 110, 253, 0.05);">
                        <div class="bg-white rounded-circle border p-1 me-3"><div class="rounded-circle bg-primary" style="width: 14px; height: 14px;"></div></div>
                        <div class="flex-grow-1">
                            <div class="fw-bold small">Meeting Persiapan VPS</div>
                            <div class="text-muted" style="font-size: 10px;">10:00 AM - Dashboard</div>
                        </div>
                    </div>

                    <div class="todo-item-mock d-flex align-items-center p-3 border-0 mb-3">
                        <div class="bg-white rounded-circle border" style="width: 24px; height: 24px; min-width: 24px;"></div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-medium small">Update Dokumentasi Laravel</div>
                            <div class="text-muted" style="font-size: 10px;">Oleh Anda Sendiri</div>
                        </div>
                    </div>

                    <div class="todo-item-mock d-flex align-items-center p-3 border-0">
                        <div class="bg-white rounded-circle border" style="width: 24px; height: 24px; min-width: 24px;"></div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-medium small">Cek Server Database</div>
                            <div class="text-muted" style="font-size: 10px;">Selesai Kan Hari Ini</div>
                        </div>
                    </div>
                </div>
                
                <div class="position-absolute bottom-0 end-0 mb-n4 me-n2 d-none d-md-block opacity-75">
                    <div class="bg-white rounded-4 shadow p-3 text-center border">
                        <div class="h3 fw-bold text-primary mb-0">24</div>
                        <div class="small text-muted fw-bold" style="font-size: 8px;">TUGAS SELESAI</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .min-vh-75 { min-height: 75vh; }
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    .bg-primary-subtle { background-color: rgba(13, 110, 253, 0.1) !important; }
</style>
@endsection
