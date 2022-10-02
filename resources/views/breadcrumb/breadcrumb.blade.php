@inject('controller', 'App\Http\Controllers\CommonController')

@php
$data = $controller::breadcrumbData($page_title);
@endphp

<div class="pagetitle">
    <div class="pagetitle d-flex justify-content-between p-3">
        <div>
            <h3>{{ $data->title }}</h3>
        </div>
        <div class="d-flex justify-content-end">
            @foreach ($data->links as $link)
                <a href="{{ route($link->url) }}" class="btn btn-outline-primary">{{ $link->text }}</a>
            @endforeach
        </div>
    </div>
</div>
