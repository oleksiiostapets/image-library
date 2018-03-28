@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col text-right">
            <a class="btn btn-light" href="/newImage">Upload <i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <div class="row dropdown-divider"></div>
    <div class="row">
        @foreach ($images as $image)
            <div class="col-3">
                <a class="thumb">
                    <img class="preview" src="{{ $image->thumb_src }}" title="{{ $image->caption }}" alt="{{ $image->alternative }}"/>
                    <div>
                        <h4 class="text-center">{{ $image->caption }}</h4>
                        <img class="full-image" src="{{ $image->image_src }}" title="{{ $image->caption }}" alt="{{ $image->alternative }}">
                        <p>{{ $image->description }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="row dropdown-divider"></div>
    <div class="row">
        <div class="col text-center">
            {{ $images->links() }}
        </div>
    </div>

@endsection

@push('scripts')
@endpush
