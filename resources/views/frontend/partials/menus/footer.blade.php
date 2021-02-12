<ul class="social__icon">
    @foreach($items as $menu_item)
        <li><a href="{{ $menu_item->link() }}"><i class="zmdi {{ $menu_item->title }}"></i></a></li>
    @endforeach
    {{-- <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
    <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
    <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
    <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li> --}}
</ul>