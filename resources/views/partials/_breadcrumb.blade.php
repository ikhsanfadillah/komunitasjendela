<div class="row">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb align-items-center m-0">
            <li class="breadcrumb-item"><a href="#" style="font-size: 1.2em"><i class="mdi mdi-home-outline"></i></a></li>
            @foreach($links as $i => $link)
                @if($i != count($links) - 1)
                    <li class="breadcrumb-item"><a @isset($link['url']) href="{{$link['url']}}" @endisset>{{$link['text']}}</a></li>
                @else
                    <li class="breadcrumb-item active" style="font-weight: 500"><a @isset($link['url']) href="{{$link['url']}}" @endisset>{{$link['text']}}</a></li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
