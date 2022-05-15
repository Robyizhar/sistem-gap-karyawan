<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    @isset($segment)
                        <li class="breadcrumb-item"><a href="{{ url('/'.Request::segment(1)) }}">{{ ucwords(str_replace("-"," ",Request::segment(1))) }}</a></li>
                        <li class="breadcrumb-item active">{{ $segment }}</li>
                    @else
                        <li class="breadcrumb-item active">{{ ucwords(str_replace("-"," ",Request::segment(1))) }}</li>
                    @endisset
                </ol>
            </div>
            <h4 class="page-title">{{ ucwords(str_replace("-"," ",Request::segment(1))) }}</h4>
        </div>
    </div>
</div>
@include('layouts.component.session')
