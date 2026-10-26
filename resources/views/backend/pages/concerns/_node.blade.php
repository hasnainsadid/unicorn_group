<ul class="ctree" data-level="{{ $level }}">
    @foreach($nodes as $node)
        <li data-id="{{ $node->id }}">
            <div class="ct-row">
                <span class="ct-drag" title="Drag to change the order">⋮⋮</span>
                <div class="ct-title">
                    <strong>{{ $node->title }}</strong>
                    <small class="text-muted">/concerns/{{ $node->path }}</small>
                </div>
                <span class="badge bg-label-{{ $node->layout === 'brand' ? 'info' : 'primary' }}">{{ $node->layout === 'brand' ? 'Details + sidebar' : 'Image + text + cards' }}</span>
                @if($node->catalogue) <span class="badge bg-label-success">PDF</span> @endif
                <div class="ct-actions">
                    <a href="{{ route('concerns.create', ['parent' => $node->id]) }}" class="btn btn-sm btn-label-secondary">+ Sub-item</a>
                    <a href="{{ route('concerns.edit', $node) }}" class="btn btn-sm btn-label-primary">Edit</a>
                    <form action="{{ route('concerns.destroy', $node) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete &quot;{{ addslashes($node->title) }}&quot;{{ $node->childrenRecursive->count() ? ' and ALL its sub-items' : '' }} permanently?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-label-danger">Delete</button>
                    </form>
                </div>
            </div>
            @if($node->childrenRecursive->count())
                @include('backend.pages.concerns._node', ['nodes' => $node->childrenRecursive, 'level' => $level + 1])
            @endif
        </li>
    @endforeach
</ul>
