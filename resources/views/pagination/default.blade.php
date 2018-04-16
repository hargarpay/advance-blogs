@if ($paginator->lastPage() > 1)
<ul class="pagination">
    <li><a href="{{ $paginator->url(1) }}">
      &laquo;
    </a></li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
    		@if($i == \Request::get('page'))
			<li class="{{($paginator->currentPage() == $i) ? 'active' : '' }}"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
			@php continue @endphp
			
		@elseif($i <= 2)
			<li class="{{($paginator->currentPage() == $i) ? 'active' : '' }}"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
			@php continue @endphp
		@elseif($i > $paginator->lastPage()-2) 
			<li class="{{($paginator->currentPage() == $i) ? 'active' : '' }}"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
			@php continue; @endphp

		@elseif($i >= (\Request::get('page')-floor(4/2)) && $i<=(\Request::get('page')+floor(4/2))) 
			<li class="{{($paginator->currentPage() == $i) ? 'active' : '' }}"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
			@php continue; @endphp

		@endif

			<li class="{{($paginator->currentPage() == $i) ? 'active' : '' }}"><a>&hellip;</a></li>
			@php $i = ($i< Request::get('page')) ? ( Request::get('page')-floor(4/2)-1) : $paginator->lastPage()-2; @endphp
            
    @endfor
    <li><a class="icon item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" href="{{ $paginator->url($paginator->currentPage()+1) }}">
      &raquo;
    </a>
    </li>
</ul> 
@endif