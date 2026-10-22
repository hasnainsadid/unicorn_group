<div class="row g-4">
    <div class="col-md-6">
        <label class="form-label">Message Title (small text above the name)</label>
        <input type="text" name="role_title" class="form-control @error('role_title') is-invalid @enderror"
               value="{{ old('role_title', $management->role_title ?? '') }}" placeholder="e.g. Chairman's Message" required>
        @error('role_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $management->name ?? '') }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Designation (shown under the message)</label>
        <input type="text" name="designation" class="form-control @error('designation') is-invalid @enderror"
               value="{{ old('designation', $management->designation ?? '') }}" placeholder="e.g. Chairman, Unicorn Group" required>
        @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Quote (one short line, optional)</label>
        <input type="text" name="quote" class="form-control @error('quote') is-invalid @enderror"
               value="{{ old('quote', $management->quote ?? '') }}" maxlength="300">
        @error('quote') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Message</label>
        <textarea name="message" rows="12" class="form-control @error('message') is-invalid @enderror" required>{{ old('message', $management->message ?? '') }}</textarea>
        <small class="text-muted">Leave an empty line between paragraphs.</small>
        @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Photo (JPG / PNG / WEBP)</label>
        <input type="file" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror">
        <small class="text-muted">If there is no photo, the initials of the name are shown instead. Big pictures are resized automatically.</small>
        @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror

        @if(!empty($management->photo))
            <div class="mt-3 d-flex align-items-center gap-3">
                <img src="{{ $management->photo_url }}" alt="" style="height:90px;width:70px;object-fit:cover;object-position:top;border-radius:8px">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remove_photo" value="1" id="remove_photo">
                    <label class="form-check-label" for="remove_photo">Remove current photo (show initials)</label>
                </div>
            </div>
        @endif
    </div>

    <div class="col-md-3">
        <label class="form-label">Order (smaller number shows first)</label>
        <input type="number" min="0" name="sort_order" class="form-control"
               value="{{ old('sort_order', $management->sort_order ?? 0) }}">
    </div>
</div>