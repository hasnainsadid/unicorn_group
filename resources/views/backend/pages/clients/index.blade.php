@extends('backend.layouts.app')
@section('title', 'Clients')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Clients</h5>
            <a href="{{ route('clients.create') }}" class="btn btn-primary">+ Add Client</a>
        </div>
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td>{{ $client->sort_order }}</td>
                            <td>
                                @if ($client->logo)
                                    <img src="{{ imageShow($client->logo) }}" alt=""
                                        style="max-height:36px;max-width:100px;object-fit:contain">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $client->name }}</td>
                            <td>
                                <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-label-primary">
                                    <i class="icon-base ti tabler-edit"></i>
                                </a>
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this client?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-label-danger">
                                        <i class="icon-base ti tabler-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No clients yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
