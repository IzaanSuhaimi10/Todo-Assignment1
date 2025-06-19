@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Todos List</h2>
        </div>
        <div class="col-md-6 text-end">
            @php
                $permissions = Auth::user()->role->permissions->pluck('description')->toArray();
            @endphp

            @if(in_array('Create', $permissions))
                <a href="{{ route('todo.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add new todo
                </a>
            @endif
        </div>
        <div class="col-md-12 mt-3">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todos as $index => $todo)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $todo->title }}</td>
                            <td>{{ $todo->description }}</td>
                            <td>
                                @if ($todo->status === 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if(in_array('Update', $permissions))
                                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                @endif

                                @if(in_array('Delete', $permissions))
                                    <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this todo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No todos found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
