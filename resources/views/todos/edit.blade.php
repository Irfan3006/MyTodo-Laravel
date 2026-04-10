@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center">
                    <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary btn-sm me-3 border-0">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h4 class="mb-0 fw-bold">Edit Tugas: <small class="text-muted">{{ $todo->title }}</small></h4>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">Judul Tugas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $todo->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Deskripsi (Opsional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description', $todo->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">
                            <i class="fas fa-save me-2"></i>Perbarui Tugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
