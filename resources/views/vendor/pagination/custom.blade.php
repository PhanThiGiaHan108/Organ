@if ($paginator->hasPages())
    <div class="product__pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a><i class="fa fa-long-arrow-left"></i></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <a>{{ $element }}</a>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
        @else
            <a><i class="fa fa-long-arrow-right"></i></a>
        @endif
    </div>
@endif
