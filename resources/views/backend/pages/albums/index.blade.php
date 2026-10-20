@extends('backend.layouts.app')
@section('title', 'Gallery')

@section('content')
<style>
    .alb-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:18px}
    .alb{border:1px solid rgba(120,130,150,.25);border-radius:12px;overflow:hidden;background:var(--bs-card-bg,#fff)}
    .alb .cov{aspect-ratio:4/3;background:#8884 center/cover no-repeat;cursor:grab;position:relative}
    .alb .cnt{position:absolute;right:8px;bottom:8px;background:rgba(0,0,0,.65);color:#fff;border-radius:20px;padding:2px 10px;font-size:.75rem}
    .alb .bd{padding:12px 14px}
    .alb .bd h6{margin:0 0 8px}
    .alb.ghost{opacity:.35}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Gallery Folders</h5>
                <small class="text-muted">Drag a folder to change its order on the website.</small>
            </div>
            <a href="{{ route('albums.create') }}" class="btn btn-primary">+ New Folder</a>
        </div>
        <div class="card-body">
            @if($albums->count())
                <div class="alb-grid" id="albGrid">
                    @foreach($albums as $album)
                        <div class="alb" data-id="{{ $album->id }}">
                            <div class="cov" style="background-image:url('{{ $album->cover_url }}')">
                                <span class="cnt">{{ $album->images->count() }} photos</span>
                            </div>
                            <div class="bd">
                                <h6>{{ $album->title }}</h6>
                                <a href="{{ route('albums.edit', $album) }}" class="btn btn-sm btn-label-primary">Open / Edit</a>
                                <form action="{{ route('albums.destroy', $album) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this folder and ALL its pictures permanently?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-label-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted py-4 mb-0">No folders yet. Click "+ New Folder".</p>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
(() => {
    const grid = document.getElementById('albGrid');
    if (!grid || typeof Sortable === 'undefined') return;
    Sortable.create(grid, {
        animation: 180,
        ghostClass: 'ghost',
        handle: '.cov',
        onEnd: () => {
            const ids = [...grid.querySelectorAll('.alb')].map(e => e.dataset.id);
            fetch(@json(route('albums.reorder')), {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': @json(csrf_token())},
                body: JSON.stringify({ids})
            }).then(r => { if (!r.ok) alert('Could not save the order.'); });
        }
    });
})();
</script>
@endsection
