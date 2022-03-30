@if ($paginator->hasPages())
    <ul id="pagination">

        @if ($paginator->onFirstPage())
            <li class="disabled page-item"><a class="page-link">«</a></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a></li>
        @endif



        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="page-item disabled"><a class="page-link">{{ $element }}</a></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="my-active"><a class="active page-link">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">»</a></li>
        @else
            <li class="page-item disabled"><a class="page-link">»</a></li>
        @endif
    </ul>
    {{-- <div>
        <p class="text-sm text-gray-700 leading-5">
            {!! __('Hiển thị') !!}
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('đến') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            {!! __('của') !!}
            <span class="font-medium">{{ $paginator->total() }}</span>
            {!! __('sản phẩm') !!}
        </p>
    </div> --}}
@endif
