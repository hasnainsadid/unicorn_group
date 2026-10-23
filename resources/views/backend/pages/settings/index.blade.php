@extends('backend.layouts.app')
@section('title', 'Settings')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @foreach ($groups as $group => $fields)
                <div class="card mb-4">
                    <h5 class="card-header">{{ $group }}</h5>
                    <div class="card-body">
                        <div class="row g-4">
                            @foreach ($fields as $field)
                                @php [$key, $label, $type, $help, $col] = array_pad($field, 5, null); @endphp
                                <div class="col-md-{{ $col ?? ($type === 'textarea' ? 12 : 6) }}">
                                    @if ($type === 'switch')
                                        <div class="form-check form-switch mt-4">
                                            <input class="form-check-input" type="checkbox" name="{{ $key }}"
                                                value="1" id="{{ $key }}"
                                                {{ old($key, setting($key, '1')) == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="{{ $key }}">{{ $label }}</label>
                                        </div>
                                    @else
                                        <label class="form-label" for="{{ $key }}">{{ $label }}</label>
                                        @if ($type === 'textarea')
                                            <textarea id="{{ $key }}" name="{{ $key }}" rows="3"
                                                class="form-control @error($key) is-invalid @enderror">{{ old($key, setting($key)) }}</textarea>
                                        @elseif($type === 'file')
                                            <input id="{{ $key }}" type="file" name="{{ $key }}"
                                                accept="image/*" class="form-control @error($key) is-invalid @enderror">
                                            @if (setting($key))
                                                <img src="{{ asset(setting($key)) }}" alt="" class="mt-2"
                                                    style="max-height:80px;border-radius:6px">
                                            @endif
                                        @else
                                            <input id="{{ $key }}" type="{{ $type }}"
                                                name="{{ $key }}"
                                                class="form-control @error($key) is-invalid @enderror"
                                                value="{{ old($key, setting($key)) }}">
                                        @endif
                                        @error($key)
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    @endif
                                    @if ($help)
                                        <small class="text-muted">{{ $help }}</small>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <button class="btn btn-primary">Save Settings</button>
        </form>
    </div>
@endsection
