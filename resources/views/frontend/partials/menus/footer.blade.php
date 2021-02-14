<ul class="social__icon">
    @foreach($items as $menu_item)
        <li><a href="{{ $menu_item->link() }}"><i class="zmdi {{ $menu_item->title }}"></i></a></li>
    @endforeach
</ul>