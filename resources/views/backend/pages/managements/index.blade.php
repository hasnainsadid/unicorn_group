@extends('backend.layouts.app')
@section('title', 'Management')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Management</h5>
        </div>
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Message Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($managements as $m)
                    <tr>
                        <td>{{ $m->sort_order }}</td>
                        <td>
                            @if($m->photo_url)
                                <img src="{{ $m->photo_url }}" alt="" style="height:48px;width:38px;object-fit:cover;object-position:top;border-radius:6px">
                            @else
                                <span class="badge bg-label-secondary">{{ $m->initials }}</span>
                            @endif
                        </td>
                        <td>{{ $m->name }}<br><small class="text-muted">{{ $m->designation }}</small></td>
                        <td>{{ $m->role_title }}</td>
                        <td>
                            <a href="{{ route('managements.edit', $m) }}" class="btn btn-sm btn-label-primary"><i class="icon-base ti tabler-edit"></i></a>
                            {{-- <form action="{{ route('managements.destroy', $m) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this member?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-label-danger">Delete</button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No members yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection