@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Users</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                    <td>
                        <form action="{{ route('admin.users.assign-role', $user) }}" method="POST">
                            @csrf
                            <select name="role_id" class="form-select">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Assign Role</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection