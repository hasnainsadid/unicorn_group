@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-5">
            <div>
                <h4 class="mb-1">Welcome back, {{ auth()->user()->name }}</h4>
                <p class="mb-0 text-body-secondary">Here is the current overview of your website.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('home') }}" target="_blank" rel="noopener" class="btn btn-label-secondary">
                    <i class="icon-base ti tabler-world me-1"></i> View website
                </a>
                <a href="{{ route('contacts.index') }}" class="btn btn-primary">
                    <i class="icon-base ti tabler-message-circle me-1"></i> View messages
                </a>
            </div>
        </div>

        <div class="row g-4 mb-4">
            @foreach ($stats as $stat)
                <div class="col-12 col-sm-6 col-xxl-4">
                    <a href="{{ route($stat['route']) }}" class="text-reset text-decoration-none d-block h-100">
                        <div class="card h-100">
                            <div class="card-body d-flex align-items-center justify-content-between gap-3">
                                <div>
                                    <p class="mb-1 text-body-secondary">{{ $stat['label'] }}</p>
                                    <h3 class="mb-0">{{ number_format($stat['value']) }}</h3>
                                </div>
                                <span class="badge bg-label-{{ $stat['color'] }} rounded p-3">
                                    <i class="icon-base ti {{ $stat['icon'] }} icon-xl"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row g-4">
            <div class="col-12 col-xl-8">
                <div class="card h-100">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <div>
                            <h5 class="mb-1">Recent contact messages</h5>
                            <p class="mb-0 text-body-secondary">The latest messages submitted through your website.</p>
                        </div>
                        <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-label-primary">All messages</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Subject</th>
                                    <th>Received</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentContacts as $contact)
                                    <tr>
                                        <td>
                                            <div class="fw-medium">{{ $contact->name }}</div>
                                            <small class="text-body-secondary">{{ $contact->email }}</small>
                                        </td>
                                        <td class="text-truncate" style="max-width: 260px" title="{{ $contact->subject }}">
                                            {{ $contact->subject }}
                                        </td>
                                        <td class="text-nowrap">{{ $contact->created_at->format('M j, Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-body-secondary">
                                            No contact messages yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-1">Quick actions</h5>
                        <p class="mb-0 text-body-secondary">Shortcuts to common content updates.</p>
                    </div>
                    <div class="card-body d-grid gap-3">
                        <a href="{{ route('sliders.create') }}" class="btn btn-label-primary text-start">
                            <i class="icon-base ti tabler-plus me-2"></i> Add a hero slide
                        </a>
                        <a href="{{ route('concerns.create') }}" class="btn btn-label-primary text-start">
                            <i class="icon-base ti tabler-building-plus me-2"></i> Add a concern
                        </a>
                        <a href="{{ route('albums.create') }}" class="btn btn-label-primary text-start">
                            <i class="icon-base ti tabler-photo-plus me-2"></i> Create a gallery album
                        </a>
                        <a href="{{ route('clients.create') }}" class="btn btn-label-primary text-start">
                            <i class="icon-base ti tabler-user-plus me-2"></i> Add a client
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
