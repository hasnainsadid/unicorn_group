@extends('backend.layouts.app')
@section('title', 'About Sections')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">About Sections</h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr><th>Image</th><th>Section</th><th>Title</th><th class="text-end">Action</th></tr>
                </thead>
                <tbody>
                @foreach($sections as $s)
                    <tr>
                        <td><img src="{{ $s->main_url }}" alt="" style="width:70px;height:48px;object-fit:cover;border-radius:6px"></td>
                        <td>{{ $s->label }}</td>
                        <td>{{ $s->title }}</td>
                        <td class="text-end"><a href="{{ route('about-sections.edit', $s) }}" class="btn btn-sm btn-label-primary"><i class="icon-base ti tabler-edit"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection