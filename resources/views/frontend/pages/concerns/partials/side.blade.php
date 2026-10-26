@foreach($nodes as $node)
    <a href="{{ $node->url }}"
       class="{{ $node->id === $current->id ? 'active' : '' }}"
       @if($depth) style="padding-left:{{ 14 + $depth * 16 }}px;font-size:.92em" @endif>{{ $depth ? '› ' : '' }}{{ $node->title }}</a>
    @if($node->childrenRecursive->count())
        @include('frontend.pages.concerns.partials.side', ['nodes' => $node->childrenRecursive, 'depth' => $depth + 1, 'current' => $current])
    @endif
@endforeach
