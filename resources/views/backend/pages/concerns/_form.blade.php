@php
    $editing = $concern->exists;
    $cards = old('cards', $concern->cards ?? []);
    $cards = array_pad(array_values($cards), 3, ['icon' => '', 'title' => '', 'text' => '']);
    $layout = old('layout', $concern->layout ?: 'feature');
@endphp

@if($errors->any())
    <div class="alert alert-danger">Please fix the errors below.</div>
@endif

{{-- ===================== BASIC ===================== --}}
<div class="card mb-4">
    <div class="card-header"><h5 class="mb-0">{{ $editing ? 'Edit: ' . $concern->title : 'New Concern' }}</h5></div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Name (shown in the menu and as the page title)</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                       value="{{ old('title', $concern->title) }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Under which item? (leave empty for a main concern)</label>
                <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                    <option value="">— Main concern (top level) —</option>
                    @foreach($parents as $id => $label)
                        <option value="{{ $id }}" @selected((string) old('parent_id', $concern->parent_id) === (string) $id)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Page layout</label>
                <select name="layout" class="form-select">
                    <option value="feature" @selected($layout === 'feature')>Image + text + 3 cards</option>
                    <option value="brand" @selected($layout === 'brand')>Details + sidebar (brand / service page)</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">URL name (optional)</label>
                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                       value="{{ old('slug', $concern->slug) }}" placeholder="auto from the name, e.g. unicorn-elevator">
                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @if($editing)
                    <small class="text-muted">Current address: /concerns/{{ $concern->path }} (changing the name changes the address).</small>
                @endif
            </div>
            <div class="col-md-6">
                <label class="form-label">Small title above the heading</label>
                <input type="text" name="eyebrow" class="form-control" value="{{ old('eyebrow', $concern->eyebrow) }}"
                       placeholder="e.g. Our Concern or Unicorn Elevator">
            </div>
            <div class="col-md-6">
                <label class="form-label">Short line (one sentence)</label>
                <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $concern->tagline) }}"
                       placeholder="Shown under the title on brand pages and on cards">
            </div>
        </div>
    </div>
</div>

{{-- ===================== CONTENT ===================== --}}
<div class="card mb-4">
    <div class="card-header"><h5 class="mb-0">Page content</h5></div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Big heading <small class="text-muted">(image + text layout)</small></label>
                <input type="text" name="heading" class="form-control" value="{{ old('heading', $concern->heading) }}"
                       placeholder="e.g. Building landmarks with trust">
            </div>
            <div class="col-md-6">
                <label class="form-label">Golden word(s) inside the heading</label>
                <input type="text" name="heading_highlight" class="form-control" value="{{ old('heading_highlight', $concern->heading_highlight) }}"
                       placeholder="e.g. landmarks">
            </div>
            <div class="col-12">
                <label class="form-label">Details text <small class="text-muted">(leave one empty line between paragraphs)</small></label>
                <textarea name="body" rows="7" class="form-control @error('body') is-invalid @enderror">{{ old('body', $concern->body) }}</textarea>
                @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-12">
                <label class="form-label">"What We Offer" list <small class="text-muted">(one point per line, used in the details + sidebar layout)</small></label>
                <textarea name="features_text" rows="6" class="form-control">{{ old('features_text', $concern->features_text) }}</textarea>
            </div>
        </div>

        <hr class="my-4">
        <h6>3 cards <small class="text-muted">(image + text layout, shown under the main section)</small></h6>
        <div class="row g-3">
            @foreach($cards as $i => $card)
                <div class="col-md-4">
                    <div class="border rounded p-3">
                        <label class="form-label">Icon (emoji)</label>
                        <input type="text" name="cards[{{ $i }}][icon]" class="form-control mb-2" value="{{ $card['icon'] ?? '' }}" maxlength="10">
                        <label class="form-label">Title</label>
                        <input type="text" name="cards[{{ $i }}][title]" class="form-control mb-2" value="{{ $card['title'] ?? '' }}">
                        <label class="form-label">Text</label>
                        <textarea name="cards[{{ $i }}][text]" rows="3" class="form-control">{{ $card['text'] ?? '' }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>

        <hr class="my-4">
        <h6>Sub-item list heading <small class="text-muted">(only if this page has sub-items)</small></h6>
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Heading</label>
                <input type="text" name="children_heading" class="form-control" value="{{ old('children_heading', $concern->children_heading) }}"
                       placeholder="e.g. Our Brands">
            </div>
            <div class="col-md-6">
                <label class="form-label">Text under the heading</label>
                <input type="text" name="children_text" class="form-control" value="{{ old('children_text', $concern->children_text) }}">
            </div>
        </div>
    </div>
</div>

{{-- ===================== PICTURES ===================== --}}
<div class="card mb-4">
    <div class="card-header"><h5 class="mb-0">Pictures</h5></div>
    <div class="card-body">
        <div class="row g-4">
            @foreach(['image' => 'Main picture', 'image2' => 'Second picture (small)'] as $field => $label)
                <div class="col-md-6">
                    <label class="form-label">{{ $label }}</label>
                    <input type="file" name="{{ $field }}" accept="image/*" class="form-control @error($field) is-invalid @enderror">
                    @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if($editing && $concern->$field)
                        <div class="mt-2 d-flex align-items-center gap-3">
                            <img src="{{ $field === 'image' ? $concern->image_url : $concern->image2_url }}" style="height:70px;border-radius:8px">
                            <label class="form-check mb-0"><input type="checkbox" class="form-check-input" name="remove_{{ $field }}" value="1"> Remove</label>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ===================== HOME ===================== --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Home page card</h5>
        <small class="text-muted">Only for main concerns (not for sub-items).</small>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-3">
                <label class="form-label">Position on home page</label>
                <input type="number" name="home_order" min="1" max="99" class="form-control" value="{{ old('home_order', $concern->home_order) }}"
                       placeholder="1, 2, 3 ...">
                <small class="text-muted">1 is the big card. Empty = not shown on home.</small>
            </div>
            <div class="col-md-3">
                <label class="form-label">Icon (emoji)</label>
                <input type="text" name="home_icon" maxlength="10" class="form-control" value="{{ old('home_icon', $concern->home_icon) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Card picture</label>
                <input type="file" name="home_image" accept="image/*" class="form-control @error('home_image') is-invalid @enderror">
                @error('home_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @if($editing && $concern->home_image)
                    <div class="mt-2 d-flex align-items-center gap-3">
                        <img src="{{ $concern->home_image_url }}" style="height:70px;border-radius:8px">
                        <label class="form-check mb-0"><input type="checkbox" class="form-check-input" name="remove_home_image" value="1"> Remove</label>
                    </div>
                @endif
            </div>
            <div class="col-12">
                <label class="form-label">Short description (home card and About page card)</label>
                <input type="text" name="home_text" maxlength="300" class="form-control" value="{{ old('home_text', $concern->home_text) }}">
            </div>
        </div>
    </div>
</div>

{{-- ===================== CATALOGUE ===================== --}}
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Catalogue (PDF)</h5>
        <small class="text-muted">Shown on the page as a book that visitors can flip. Leave empty for no catalogue.</small>
    </div>
    <div class="card-body">
        <input type="file" name="catalogue" accept="application/pdf" class="form-control @error('catalogue') is-invalid @enderror">
        @error('catalogue') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if($editing && $concern->catalogue)
            <div class="mt-2 d-flex align-items-center gap-3">
                <a href="{{ $concern->catalogue_url }}" target="_blank">Current PDF</a>
                <label class="form-check mb-0"><input type="checkbox" class="form-check-input" name="remove_catalogue" value="1"> Remove</label>
            </div>
        @endif
    </div>
</div>

{{-- ===================== SEO ===================== --}}
<div class="card mb-4">
    <div class="card-header"><h5 class="mb-0">Google / SEO (optional)</h5></div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label">Page title for Google</label>
                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $concern->meta_title) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Description for Google</label>
                <input type="text" name="meta_description" maxlength="300" class="form-control" value="{{ old('meta_description', $concern->meta_description) }}">
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary">{{ $editing ? 'Save Changes' : 'Create' }}</button>
<a href="{{ route('concerns.index') }}" class="btn btn-label-secondary">Cancel</a>
