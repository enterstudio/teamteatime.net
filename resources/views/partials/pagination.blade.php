@if ($items->lastPage() > 1)
    <div class="text-center">
        <ul class="pagination">
            <li class="arrow {{ ($items->currentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $items->url(1) }}">&laquo;</a>
            </li>
            @for ($i = 1; $i <= $items->lastPage(); $i++)
            <li class="{{ ($items->currentPage() == $i) ? ' active' : '' }}">
                <a href="{{ $items->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="arrow {{ ($items->currentPage() == $items->lastPage()) ? ' disabled' : '' }}">
                <a href="{{ $items->url($items->currentPage()+1) }}">&raquo;</a>
            </li>
        </ul>
    </div>
@endif
