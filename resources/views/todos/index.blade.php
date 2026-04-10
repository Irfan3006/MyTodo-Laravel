@extends('layouts.app')

@section('title', 'Tugas Saya')

@section('content')
<div class="row align-items-center mb-5 g-3">
    <div class="col-md-7">
        <h2 class="fw-bold mb-1">Daftar Tugas Anda</h2>
        <p class="text-secondary opacity-75 mb-0">Kelola dan pantau semua tugas Anda dalam satu tempat.</p>
    </div>
    <div class="col-md-5 text-md-end">
        <a href="{{ route('todos.create') }}" class="btn btn-primary shadow-sm px-4 py-2 border-0 rounded-3">
            <i class="fas fa-plus me-2"></i>Tambah Tugas
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white bg-opacity-50 border-bottom-0 p-4">
        <form id="filter-form" class="row g-3">
            <div class="col-lg-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 ps-3">
                        <i class="fas fa-search text-muted small"></i>
                    </span>
                    <input type="text" name="search" id="search-input" class="form-control bg-light border-0 py-2 ps-2" placeholder="Cari judul tugas..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <select name="status" id="status-filter" class="form-select bg-light border-0 py-2">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Belum Selesai</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-6 col-lg-3">
                <select name="sort" id="sort-filter" class="form-select bg-light border-0 py-2">
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama</option>
                </select>
            </div>
            <div class="col-lg-1 d-none d-lg-block">
                <button type="submit" class="btn btn-primary w-100 py-2 border-0">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        <div id="todo-list-container">
            @include('todos.partials.list')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script nonce="{{ $cspNonce }}">
    $(document).ready(function() {
        $(document).off('change', '.toggle-todo').on('change', '.toggle-todo', function(e) {
            e.stopImmediatePropagation();
            
            const checkbox = $(this);
            const id = checkbox.data('id');
            const url = checkbox.data('url');
            const row = checkbox.closest('.todo-item');
            const titleSpan = row.find('.todo-title');
            
            checkbox.prop('disabled', true);
            
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _method: 'PATCH'
                },
                success: function(response) {
                    console.log('Toggle Response:', response);
                    if (response.completed) {
                        titleSpan.addClass('completed text-muted');
                        row.addClass('bg-light-subtle');
                    } else {
                        titleSpan.removeClass('completed text-muted');
                        row.removeClass('bg-light-subtle');
                    }
                },
                error: function(xhr) {
                    alert('Gagal memperbarui tugas: ' + xhr.status + ' (' + xhr.statusText + ')');
                    checkbox.prop('checked', !checkbox.prop('checked'));
                },
                complete: function() {
                    checkbox.prop('disabled', false);
                }
            });
        });

        $(document).on('click', '.delete-todo', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const row = $(this).closest('.todo-item');
            
            if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                $.ajax({
                    url: `/todos/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        row.fadeOut(300, function() {
                            $(this).remove();
                            if ($('.todo-item').length === 0) {
                                location.reload();
                            }
                        });
                    }
                });
            }
        });

        const fetchTodos = () => {
            const search = $('#search-input').val();
            const status = $('#status-filter').val();
            const sort = $('#sort-filter').val();
            
            $.ajax({
                url: "{{ route('todos.index') }}",
                data: { search, status, sort },
                success: function(data) {
                    $('#todo-list-container').html(data);
                }
            });
        };

        $('#search-input').on('input', function() {
            clearTimeout(window.searchTimer);
            window.searchTimer = setTimeout(fetchTodos, 400);
        });

        $('#status-filter, #sort-filter').on('change', fetchTodos);
        $('#filter-form').on('submit', function(e) { e.preventDefault(); fetchTodos(); });
    });
</script>
@endpush
