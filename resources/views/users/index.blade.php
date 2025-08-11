@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Manajemen Pengguna</h1>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Tambah Pengguna Baru
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <form action="{{ route('users.index') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <select name="role" class="form-select">
                                <option value="">Semua Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->slug }}" {{ request('role') == $role->slug ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="department" class="form-select">
                                <option value="">Semua Departemen</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->name }}" {{ request('department') == $department->name ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-secondary">Filter</button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if(count($users) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Departemen</th>
                                        <th>ID Karyawan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role->name }}</td>
                                            <td>{{ $user->department }}</td>
                                            <td>{{ $user->employee_id }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> Detail
                                                    </a>
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    @if($user->id != auth()->id())
                                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $users->links() }}
                        </div>
                    @else
                        <p class="text-center py-3">Tidak ada pengguna yang ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
