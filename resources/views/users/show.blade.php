@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Detail Pengguna</h1>
                <div>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informasi Pengguna</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Nama:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role:</th>
                                    <td>{{ $user->role->name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Departemen:</th>
                                    <td>{{ $user->department ?: 'Tidak ada' }}</td>
                                </tr>
                                <tr>
                                    <th>ID Karyawan:</th>
                                    <td>{{ $user->employee_id ?: 'Tidak ada' }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bergabung:</th>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
