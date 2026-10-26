@extends('backend.layouts.app')
@section('title', 'Concerns')

@section('content')
<style>
    .ctree{list-style:none;margin:0;padding:0}
    .ctree .ctree{margin:6px 0 0 34px;padding-left:14px;border-left:2px dashed rgba(120,130,150,.35)}
    .ctree li{margin-bottom:8px}
    .ct-row{display:flex;align-items:center;gap:12px;flex-wrap:wrap;padding:10px 14px;border:1px solid rgba(120,130,150,.25);border-radius:10px;background:var(--bs-card-bg,#fff)}
    .ct-drag{cursor:grab;font-size:1.2rem;color:#8a94a6;user-select:none;letter-spacing:-3px}
    .ct-title{flex:1;min-width:200px;display:flex;flex-direction:column}
    .ct-actions{display:flex;gap:6px;flex-wrap:wrap}
    .ctree li.ghost > .ct-row{opacity:.35}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-0">Concerns</h5>
                <small class="text-muted">Drag ⋮⋮ to change the order. The same order is used in the menu and on the About page. Sub-items appear in the dropdown menu.</small>
            </div>
            <a href="{{ route('concerns.create') }}" class="btn btn-primary">+ New Concern</a>
        </div>
        <div class="card-body">
            @if($concerns->count())
                @include('backend.pages.concerns._node', ['nodes' => $concerns, 'level' => 0])
            @else
                <p class="text-center text-muted py-4 mb-0">No concerns yet. Click "+ New Concern".</p>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
(() => {
    if (typeof Sortable === 'undefined') return;
    document.querySelectorAll('.ctree').forEach((list, i) => {
        Sortable.create(list, {
            animation: 160,
            ghostClass: 'ghost',
            handle: '.ct-drag',
            group: 'list-' + i,           // items stay inside their own list (same parent)
            onEnd: () => {
                const ids = [...list.children].map(li => li.dataset.id);
                fetch(@json(route('concerns.reorder')), {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': @json(csrf_token())},
                    body: JSON.stringify({ids})
                }).then(r => { if (!r.ok) alert('Could not save the order.'); });
            }
        });
    });
})();
</script>
@endsection
