@if ($paginator->hasPages())
    <div class="paginate">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="javascript:" class="btn btn-outline-secondary float-left disabled">&larr; Newer</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="btn btn-outline-secondary float-left">&larr; Newer</a>
        @endif
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="btn btn-outline-dark float-right">Older &rarr;</a>
        @else
            <a href="javascript:" class="btn btn-outline-dark float-right disabled">Older &rarr;</a>
        @endif
    </div>
@endif
