@extends('product.layout')

@section('contect')

    <div class="container">
        <h2>Edit Event</h2>
        <p><a href="{{ route('event.index') }}" class="btn btn-primary">BACK</a></p>
        <form class="form-horizontal" action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="control-label col-sm-2" for="title">Title:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ $event->title }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ $event->name }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="desc">Description:</label>
                <div class="col-sm-10">
                    <textarea name="desc" id="desc" class="summernote" required>{!! $event->desc !!}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="images">Images:</label>
                <div class="col-sm-10">
                    @if($event->image)
                        @php
                            $images = json_decode($event->image);
                        @endphp
                        @foreach($images as $image)
                            <div>
                                <img src="{{ asset($image) }}" alt="Event Image" style="width: 100px; height: auto;">
                                <label><input type="checkbox" name="delete_images[]" value="{{ $image }}"> Delete</label>
                            </div>
                        @endforeach
                    @endif
                    <input type="file" class="form-control" id="images[]" name="images[]" multiple>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="video">Video:</label>
                <div class="col-sm-10">
                    @if($event->video)
                        <video width="120" height="90" controls>
                            <source src="{{ asset($event->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <label><input type="checkbox" name="delete_video" value="1"> Delete Video</label>
                    @endif
                    <input type="file" class="form-control" id="video" name="video">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>

@endsection
