@extends('backend.layouts.app')
@section('title', 'Hero Slider')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Hero Slider</h5>
                <a href="{{ route('sliders.create') }}" class="btn btn-primary">
                    <i class="icon-base ti tabler-plus me-1"></i> Add Slide
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Title</th>
                            <th>Buttons</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($sliders as $slider)
                            <tr>
                                <td>{{ $slider->sort_order }}</td>
                                <td>
                                    <small class="text-muted d-block">{{ $slider->eyebrow }}</small>
                                    {!! $slider->title_html !!}
                                </td>
                                <td>
                                    {{ $slider->btn1_text }}
                                    @if ($slider->btn2_text) / {{ $slider->btn2_text }} @endif
                                </td>
                                <td>
                                    <form action="{{ route('sliders.toggle', $slider->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="badge border-0 {{ $slider->status ? 'bg-label-success' : 'bg-label-secondary' }}">
                                            {{ $slider->status ? 'Active' : 'Hidden' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('sliders.edit', $slider->id) }}" class="btn text-warning btn-icon">
                                        <i class="icon-base ti tabler-edit"></i>
                                    </a>
                                    <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Delete this slide?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn text-danger btn-icon">
                                            <i class="icon-base ti tabler-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No slides found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection