                            
<nav class="mainmenu__nav hidden-xs hidden-sm">
    <ul class="main__menu">
        @foreach($items as $menu_item)
            <li class="drop"><a href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a></li>
        @endforeach
    </ul>
</nav>