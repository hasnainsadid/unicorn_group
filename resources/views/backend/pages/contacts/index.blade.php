@extends('backend.layouts.app')
@section('title', 'Contact Us')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">All Contacts</h5>
            <div class="table-responsive text-nowrap">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
                                <td>{!! wordwrap($contact->message, 40, '<br>') !!}</td>
                                <td>
                                    <a class="dropdown-item waves-effect text-danger"
                                        onclick="document.getElementById('delete-{{ $contact->id }}').submit();"
                                        href="javascript:void(0);">
                                        <i class="icon-base ti tabler-trash me-1"></i>
                                    </a>
                                    <form id="delete-{{ $contact->id }}"
                                        action="{{ route('contacts.destroy', $contact->id) }}" method="post"
                                        class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No contacts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
