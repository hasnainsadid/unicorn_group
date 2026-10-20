@extends('backend.layouts.app')
@section('title', 'Edit Folder')

@section('content')
<style>
    .dz{border:2px dashed rgba(245,165,36,.7);border-radius:14px;padding:34px 16px;text-align:center;cursor:pointer;transition:.2s;background:rgba(245,165,36,.05)}
    .dz.over{background:rgba(245,165,36,.18);border-color:#f5a524}
    .dz .big{font-size:2.2rem;line-height:1}
    .pic-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:14px;margin-top:22px}
    .pic{position:relative;border:1px solid rgba(120,130,150,.25);border-radius:12px;overflow:hidden;background:var(--bs-card-bg,#fff)}
    .pic .thumb{aspect-ratio:1/1;background:#8884 center/cover no-repeat;cursor:grab}
    .pic .thumb:active{cursor:grabbing}
    .pic .cap{padding:8px}
    .pic .cap input{font-size:.8rem}
    .pic .del{position:absolute;top:6px;right:6px;width:28px;height:28px;border:0;border-radius:50%;background:rgba(0,0,0,.65);color:#fff;line-height:1;font-size:15px;cursor:pointer}
    .pic .del:hover{background:#e5484d}
    .pic .badge-cover{position:absolute;top:6px;left:6px;background:#f5a524;color:#1a1200;font-size:.7rem;font-weight:700;border-radius:20px;padding:2px 9px;display:none}
    .pic:first-child .badge-cover{display:block}
    .pic.ghost{opacity:.35}
    .pic.up .thumb{display:grid;place-items:center;font-size:.75rem;color:#888;padding:10px;text-align:center;word-break:break-all;cursor:default}
    .pic .bar{height:5px;background:rgba(120,130,150,.25)}
    .pic .bar i{display:block;height:100%;width:0;background:#f5a524;transition:width .15s}
    .pic.err .bar i{background:#e5484d;width:100%}
    .pic .msg{font-size:.72rem;color:#e5484d;padding:6px 8px}
</style>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Folder Details</h5>
            <a href="{{ route('albums.index') }}" class="btn btn-label-secondary btn-sm">← All Folders</a>
        </div>
        <div class="card-body">
            <form action="{{ route('albums.update', $album) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    <div class="col-md-5">
                        <label class="form-label">Folder Name</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $album->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Short Description (optional)</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                               value="{{ old('description', $album->description) }}">
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Pictures (<span id="count">{{ $album->images->count() }}</span>)</h5>
            <small class="text-muted">Drag pictures to sort them. The first picture is the folder cover. JPG, PNG or WEBP, up to 10 MB each.</small>
        </div>
        <div class="card-body">

            <div class="dz" id="dz">
                <div class="big">📷</div>
                <p class="mb-1"><b>Drag &amp; drop pictures (or a whole folder) here</b></p>
                <p class="mb-3 text-muted">or</p>
                <button type="button" class="btn btn-primary btn-sm" id="pickFiles">Choose pictures</button>
                <button type="button" class="btn btn-label-primary btn-sm" id="pickFolder">Choose a folder</button>
                <div class="mt-3 small text-muted" id="status"></div>
            </div>
            <input type="file" id="fileInput" accept="image/jpeg,image/png,image/webp" multiple hidden>
            <input type="file" id="folderInput" webkitdirectory multiple hidden>

            <div class="pic-grid" id="grid">
                @foreach($album->images as $img)
                    <div class="pic" data-id="{{ $img->id }}">
                        <span class="badge-cover">COVER</span>
                        <button type="button" class="del" title="Delete">×</button>
                        <div class="thumb" style="background-image:url('{{ $img->url }}')"></div>
                        <div class="cap"><input type="text" class="form-control form-control-sm" placeholder="Caption (optional)" maxlength="150" value="{{ $img->caption }}"></div>
                    </div>
                @endforeach
            </div>
            <p class="text-center text-muted mt-4 mb-0" id="empty" @if($album->images->count()) style="display:none" @endif>No pictures yet.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
(() => {
    const URLS = {
        upload:  @json(route('albums.images.store', $album)),
        reorder: @json(route('albums.images.reorder', $album)),
        update:  @json(route('album-images.update', '__ID__')),
        destroy: @json(route('album-images.destroy', '__ID__')),
    };
    const TOKEN = @json(csrf_token());
    const MAX = 10 * 1024 * 1024, PARALLEL = 3;

    const $ = id => document.getElementById(id);
    const grid = $('grid'), dz = $('dz'), statusEl = $('status'), emptyEl = $('empty');
    const api = (url, method, body) => fetch(url, {
        method,
        headers: {'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': TOKEN},
        body: body ? JSON.stringify(body) : undefined
    });

    const refresh = () => {
        const n = grid.querySelectorAll('.pic[data-id]').length;
        $('count').textContent = n;
        emptyEl.style.display = grid.children.length ? 'none' : '';
    };
    const saveOrder = () => {
        const ids = [...grid.querySelectorAll('.pic[data-id]')].map(e => +e.dataset.id);
        if (!ids.length) return;
        api(URLS.reorder, 'POST', {ids}).then(r => { if (!r.ok) alert('Could not save the order.'); });
    };

    /* sorting by drag */
    Sortable.create(grid, { animation: 180, ghostClass: 'ghost', handle: '.thumb', onEnd: saveOrder });

    /* caption (saved when you leave the field) and delete */
    grid.addEventListener('change', e => {
        if (!e.target.matches('.cap input')) return;
        const id = e.target.closest('.pic').dataset.id;
        api(URLS.update.replace('__ID__', id), 'PUT', {caption: e.target.value})
            .then(r => { if (!r.ok) alert('Could not save the caption.'); });
    });
    grid.addEventListener('click', e => {
        const b = e.target.closest('.del'); if (!b) return;
        const card = b.closest('.pic');
        if (!card.dataset.id) { card.remove(); refresh(); return; }          /* failed upload */
        if (!confirm('Delete this picture permanently?')) return;
        api(URLS.destroy.replace('__ID__', card.dataset.id), 'DELETE').then(r => {
            if (!r.ok) return alert('Could not delete the picture.');
            card.remove(); refresh();
        });
    });

    /* upload queue */
    const queue = []; let active = 0, total = 0, done = 0, failed = 0;
    const showStatus = () => {
        if (!total) { statusEl.textContent = ''; return; }
        statusEl.textContent = (done + failed < total ? 'Uploading ' : 'Finished: ') + done + ' / ' + total + ' done' + (failed ? ', ' + failed + ' failed' : '');
    };
    const errText = xhr => {
        if (xhr.status === 413) return 'File is too big for the server (check upload_max_filesize / post_max_size in php.ini).';
        try {
            const j = JSON.parse(xhr.responseText);
            if (j.errors) return Object.values(j.errors)[0][0];
            if (j.message) return j.message;
        } catch (e) {}
        return 'Upload failed (' + xhr.status + ').';
    };
    const addFiles = files => {
        const list = [...files].filter(f => /^image\/(jpeg|png|webp)$/.test(f.type));
        const skipped = files.length - list.length;
        list.sort((a, b) => a.name.localeCompare(b.name, undefined, {numeric: true}));
        list.forEach(f => {
            if (f.size > MAX) { failed++; total++; addErrorCard(f.name, 'Larger than 10 MB.'); return; }
            total++; queue.push({file: f, card: placeholder(f.name)});
        });
        if (skipped > 0) alert(skipped + ' file(s) skipped (only JPG, PNG or WEBP pictures are allowed).');
        refresh(); showStatus(); pump();
    };
    const placeholder = name => {
        const d = document.createElement('div');
        d.className = 'pic up';
        d.innerHTML = '<button type="button" class="del" title="Remove">×</button><div class="thumb"></div><div class="bar"><i></i></div>';
        d.querySelector('.thumb').textContent = name;
        grid.appendChild(d);
        return d;
    };
    const addErrorCard = (name, msg) => {
        const d = placeholder(name); d.classList.add('err');
        const m = document.createElement('div'); m.className = 'msg'; m.textContent = msg; d.appendChild(m);
    };
    const pump = () => {
        while (active < PARALLEL && queue.length) upload(queue.shift());
        if (!active && !queue.length && total) { saveOrder(); }
    };
    const upload = ({file, card}) => {
        active++;
        const xhr = new XMLHttpRequest(), fd = new FormData();
        fd.append('image', file);
        xhr.open('POST', URLS.upload);
        xhr.setRequestHeader('Accept', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', TOKEN);
        xhr.upload.onprogress = e => { if (e.lengthComputable) card.querySelector('.bar i').style.width = (e.loaded / e.total * 100) + '%'; };
        const finish = ok => { active--; ok ? done++ : failed++; showStatus(); refresh(); pump(); };
        xhr.onload = () => {
            if (xhr.status >= 200 && xhr.status < 300) {
                const j = JSON.parse(xhr.responseText);
                card.className = 'pic'; card.dataset.id = j.id;
                card.innerHTML = '<span class="badge-cover">COVER</span><button type="button" class="del" title="Delete">×</button>' +
                    '<div class="thumb"></div><div class="cap"><input type="text" class="form-control form-control-sm" placeholder="Caption (optional)" maxlength="150"></div>';
                card.querySelector('.thumb').style.backgroundImage = "url('" + j.url + "')";
                finish(true);
            } else {
                card.classList.add('err');
                const m = document.createElement('div'); m.className = 'msg'; m.textContent = errText(xhr); card.appendChild(m);
                finish(false);
            }
        };
        xhr.onerror = () => {
            card.classList.add('err');
            const m = document.createElement('div'); m.className = 'msg'; m.textContent = 'Network error.'; card.appendChild(m);
            finish(false);
        };
        xhr.send(fd);
    };

    /* drop zone: also reads whole folders */
    const walk = entry => new Promise(resolve => {
        if (entry.isFile) return entry.file(f => resolve([f]), () => resolve([]));
        if (!entry.isDirectory) return resolve([]);
        const reader = entry.createReader(), all = [];
        (function read() {
            reader.readEntries(batch => {
                if (!batch.length) return Promise.all(all.map(walk)).then(r => resolve(r.flat()));
                all.push(...batch); read();
            }, () => resolve([]));
        })();
    });
    const filesFromDrop = async dt => {
        const entries = [...dt.items].map(i => i.webkitGetAsEntry && i.webkitGetAsEntry()).filter(Boolean);   /* read right away, the list expires after an await */
        if (!entries.length) return [...dt.files];
        return (await Promise.all(entries.map(walk))).flat();
    };

    ['dragenter', 'dragover'].forEach(ev => dz.addEventListener(ev, e => { e.preventDefault(); dz.classList.add('over'); }));
    ['dragleave', 'drop'].forEach(ev => dz.addEventListener(ev, e => { e.preventDefault(); dz.classList.remove('over'); }));
    dz.addEventListener('drop', async e => addFiles(await filesFromDrop(e.dataTransfer)));
    dz.addEventListener('click', e => { if (e.target === dz || e.target.classList.contains('big') || e.target.tagName === 'P') $('fileInput').click(); });
    $('pickFiles').onclick = () => $('fileInput').click();
    $('pickFolder').onclick = () => $('folderInput').click();
    ['fileInput', 'folderInput'].forEach(id => $(id).addEventListener('change', e => { addFiles(e.target.files); e.target.value = ''; }));

    /* stop the browser from opening a picture dropped outside the box */
    ['dragover', 'drop'].forEach(ev => window.addEventListener(ev, e => { if (!dz.contains(e.target)) e.preventDefault(); }));
})();
</script>
@endsection
