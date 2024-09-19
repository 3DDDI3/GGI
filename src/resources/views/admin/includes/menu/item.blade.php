@if (!empty($route) && !empty($name))
    @php
        $route_url = route($route, false, false);
        $route_url = trim($route_url, '/');
        $access =  isset($all) && $all ? true : \App\Helpers\Admin\Helper::checkRights(route($route), 'read');
    @endphp
    @if ($access)
        <a href="{{ route($route) }}"
            class="{{ Request::is($route_url.'/*') || Request::is($route_url) ? 'active' : '' }}">
            {{ $name }}
        </a>
    @endif
@endif
