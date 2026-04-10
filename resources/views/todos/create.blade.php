@extends('layouts.app')

@section('title', 'Tambah Tugas Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center">
                    <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary btn-sm me-3 border-0">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h4 class="mb-0 fw-bold">Tambah Tugas Baru</h4>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('todos.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Judul Tugas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Apa yang harus dikerjakan?" required autofocus>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Deskripsi (Opsional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Detail tugas tambahan...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">
                            <i class="fas fa-save me-2"></i>Simpan Tugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
