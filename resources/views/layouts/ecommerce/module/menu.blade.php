<ul>
    <li><a href="{{url('shop')}}">Shop</a>
    </li>
    <li><a href="#">Chapter</a>
        <ul class="dropdown">
        @foreach($chapter as $chapter)
            <li><a href="{{url('/chapter/' . $chapter->slug)}}">{{$chapter->name}}</a></li>
            @endforeach
        </ul>
    </li>
    <li><a href="{{url('/about')}}">About</a></li>
    <li><a href="{{url('/contact')}}">Contact</a></li>
</ul>