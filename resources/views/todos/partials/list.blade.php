<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light-subtle">
            <tr>
                <th width="40" class="ps-4"></th>
                <th class="py-3">Tugas</th>
                <th class="d-none d-md-table-cell py-3">Deskripsi</th>
                <th class="text-end pe-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($todos as $todo)
                <tr class="todo-item {{ $todo->is_completed ? 'bg-light-subtle' : '' }}">
                    <td class="ps-4">
                        <div class="form-check">
                            <input class="form-check-input toggle-todo" type="checkbox" style="width: 1.2rem; height: 1.2rem;" data-id="{{ $todo->id }}" data-url="{{ route('todos.toggle', $todo->id) }}" {{ $todo->is_completed ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <span class="todo-title fw-bold {{ $todo->is_completed ? 'completed text-muted' : '' }}">
                            {{ $todo->title }}
                        </span>
                        <div class="d-md-none text-muted small mt-1">
                            {{ Str::limit($todo->description, 40) ?: 'Tidak ada deskripsi' }}
                        </div>
                    </td>
                    <td class="d-none d-md-table-cell text-secondary small">
                        {{ Str::limit($todo->description, 80) ?: '-' }}
                    </td>
                    <td class="text-end pe-4">
                        <div class="dropdown">
                            <button class="btn btn-link link-secondary border-0 p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <li>
                                    <a href="{{ route('todos.edit', $todo->id) }}" class="dropdown-item py-2">
                                        <i class="fas fa-edit me-2 text-primary"></i> Edit
                                    </a>
                                </li>
                                <li>
                                    <button class="dropdown-item py-2 delete-todo" data-id="{{ $todo->id }}">
                                        <i class="fas fa-trash-alt me-2 text-danger"></i> Hapus
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <div class="py-4">
                            <div class="bg-primary-subtle text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-clipboard-list fa-2x"></i>
                            </div>
                            <h5 class="fw-bold mb-1 text-body">Tidak ada tugas</h5>
                            <p class="text-muted small mb-3">Mulai hari Anda dengan membuat tugas baru!</p>
                            <a href="{{ route('todos.create') }}" class="btn btn-primary btn-sm px-4 rounded-3">
                                Buat Tugas Pertama
                            </a>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($todos->hasPages())
    <div class="border-top p-4 d-flex justify-content-center" id="pagination-links">
        {{ $todos->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
@endif
