@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col-md-8">
        <h2 class="fw-bold mb-1">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="text-secondary opacity-75">Kelola produktivitas harian Anda dengan lebih tertata.</p>
    </div>
    <div class="col-md-4 text-md-end">
        <a href="{{ route('todos.create') }}" class="btn btn-primary shadow-sm px-4">
            <i class="fas fa-plus me-2"></i>Tambah Tugas
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-shrink-0 bg-primary-subtle text-primary p-3 rounded-4 me-3">
                    <i class="fas fa-list-ul fa-xl"></i>
                </div>
                <div>
                    <h6 class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Total Tugas</h6>
                    <h3 class="mb-0 fw-bold">{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-shrink-0 bg-success-subtle text-success p-3 rounded-4 me-3">
                    <i class="fas fa-check-circle fa-xl"></i>
                </div>
                <div>
                    <h6 class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Selesai</h6>
                    <h3 class="mb-0 fw-bold text-success">{{ $stats['completed'] }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm rounded-4">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="flex-shrink-0 bg-warning-subtle text-warning p-3 rounded-4 me-3">
                    <i class="fas fa-hourglass-half fa-xl"></i>
                </div>
                <div>
                    <h6 class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Menunggu</h6>
                    <h3 class="mb-0 fw-bold text-warning">{{ $stats['pending'] }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-5">
    <div class="card border-0 bg-primary shadow rounded-5 p-4 overflow-hidden position-relative animate-up">
        <div class="position-absolute top-0 end-0 bg-white opacity-10 rounded-circle" style="width: 151px; height: 151px; margin-top: -30px; margin-right: -30px;"></div>
        <div class="position-absolute bottom-0 start-0 bg-white opacity-5 rounded-circle" style="width: 100px; height: 100px; margin-bottom: -20px; margin-left: -20px;"></div>
        
        <div class="card-body p-4 text-center text-white position-relative">
            <h3 class="fw-bold mb-3">Siap Tingkatkan Fokus Anda?</h3>
            <p class="opacity-75 mb-4 px-lg-5">Semakin banyak tugas yang Anda catat, semakin tenang pikiran Anda untuk fokus pada penyelesaian.</p>
            <div class="d-flex justify-content-center gap-3 mt-2">
                <a href="{{ route('todos.index') }}" class="btn btn-light btn-lg px-5 fw-bold text-primary rounded-4">Buka Tugas</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .animate-up {
        animation: slideUp 0.8s ease-out;
    }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .bg-primary-subtle { background-color: rgba(13, 110, 253, 0.1) !important; }
    .bg-success-subtle { background-color: rgba(25, 135, 84, 0.1) !important; }
    .bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1) !important; }
</style>
@endsection
