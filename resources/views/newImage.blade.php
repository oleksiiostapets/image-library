@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <a href="\">Images List</a>
        </div>
    </div>
    <div class="row dropdown-divider"></div>
    <form action="/uploadImage" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <div class="row">
            <div class="col text-right">
                <label for="image">Select image to upload:</label>
            </div>
            <div class="col">
                <input type="file" name="image" />
                @if ($errors->has('image'))
                    <div><small class="error text-danger">{{ $errors->first('image') }}</small></div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col text-right">
                <label for="caption">Caption:</label>
            </div>
            <div class="col">
                <input type="text" name="caption" placeholder="Some Caption" />
                @if ($errors->has('caption'))
                    <div><small class="error text-danger">{{ $errors->first('caption') }}</small></div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col text-right">
                <label for="description">Description:</label>
            </div>
            <div class="col">
                <textarea name="description" placeholder="Some description"></textarea>
                @if ($errors->has('description'))
                    <div><small class="error text-danger">{{ $errors->first('description') }}</small></div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col text-right">
                <label for="alt">Alternative text:</label>
            </div>
            <div class="col">
                <input type="text" name="alternative" placeholder="Some Alternative text" />
                @if ($errors->has('alternative'))
                    <div><small class="error text-danger">{{ $errors->first('alternative') }}</small></div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col">
            </div>

            <div class="col">
                <input type="submit" value="Upload" name="submit">
            </div>
        </div>
    </form>
@endsection

@push('title')
- Upload
@endpush

@push('scripts')
@endpush
