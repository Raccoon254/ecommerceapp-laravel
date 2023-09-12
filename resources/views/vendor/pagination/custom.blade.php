<ul class="pagination">
    @if ($paginator->onFirstPage())
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true">&laquo;</span>
        </li>
    @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
        </li>
    @endif

    <!-- Pagination links here -->

    @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
        </li>
    @else
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true">&raquo;</span>
        </li>
    @endif
</ul>
