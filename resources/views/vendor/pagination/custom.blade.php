@if ($paginator->hasPages())
<div class="pt-10 d-flex flex-wrap justify-content-between">
    <div class="left">
        <p class="text-sm text-gray">Showing {{ $paginator->firstItem() }} to {{$paginator->lastItem()}} of {{$paginator->total()}} entries</p>
    </div>
    <div class="right table-pagination">
        <ul class="d-flex justify-content-end align-items-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="ms-2 disabled" aria-disabled="true"><span><i class="lni lni-angle-double-left"></i></span></li>
            @else
                <li class="ms-2"><a href="{{ $paginator->previousPageUrl() }}"><i class="lni lni-angle-double-left"></i></a></li>
            @endif
            
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="ms-2 disabled"><span> {{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="ms-2"><a class="active"> {{ $page }} </a></li>
                        @else
                            <li class="ms-2 pagination"><a href="{{ $url }}"> {{ $page }} </a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="ms-2"><a href="{{ $paginator->nextPageUrl() }}"><i class="lni lni-angle-double-right"></i></a></li>
            @else
                <li class="ms-2 disabled"><span><i class="lni lni-angle-double-right"></i></span></li>
            @endif
        </ul>
    </div>
</div>
@endif