@extends('backend.layouts.app')
@section('title', 'Contact Us')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">All Recycle Contacts</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>
                                    {{ $contact->subject }}
                                </td>
                                {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
                                <td>{!! wordwrap($contact->message, 40, '<br>') !!}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <form id="restore-form-{{ $contact->id }}"
                                                action="{{ route('contacts.restore', $contact->id) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"
                                                onclick="event.preventDefault(); document.getElementById('restore-form-{{ $contact->id }}').submit();">
                                                <i class="icon-base ti tabler-restore me-1"></i> Restore
                                            </a>

                                            <a class="dropdown-item waves-effect" onclick="deleteData({{ $contact->id }})"
                                                href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i>
                                                Delete</a>
                                            <form id="delete-form-{{ $contact->id }}"
                                                action="{{ route('contacts.forceDelete', $contact->id) }}" method="post"
                                                class="d-none">
                                                @csrf
                                                @method('delete')
                                            </form>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No recycle contacts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
