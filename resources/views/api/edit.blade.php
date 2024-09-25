<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Event</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/buds.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Edit Event</h2>
        <form id="eventForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="eventId" name="eventId" value="{{ $event->id }}">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $event->name }}" required>
            </div>
            <div class="form-group">
                <label for="desc">Description:</label>
                <textarea class="form-control" id="desc" name="desc" required>{{ $event->desc }}</textarea>
            </div>
            <div class="form-group">
                <label for="images">Images:</label>
                <div id="existingImages">
                    @if($event->image)
                        @foreach(json_decode($event->image) as $image)
                            <div class="existing-image">
                                <img src="{{ asset($image) }}" alt="Existing Image" style="width: 100px; height: auto; margin-right: 10px;">
                                <input type="checkbox" name="delete_images[]" value="{{ $image }}"> Delete
                            </div>
                        @endforeach
                    @else
                        <p>No images available.</p>
                    @endif
                </div>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
            </div>
            <div class="form-group">
                <label for="video">Video:</label>
                @if($event->video)
                    <video width="120" height="90" controls>
                        <source src="{{ asset($event->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <input type="checkbox" name="delete_video" value="1"> Delete Video
                @else
                    <p>No video available.</p>
                @endif
                <input type="file" class="form-control" id="video" name="video">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <div id="response" class="mt-3"></div>
    </div>

    <script>
        $(document).ready(function() {
            var eventId = $('#eventId').val();

            $('#eventForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                var token = localStorage.getItem('token');

                if (!token) {
                    alert('Token not found! Please log in.');
                    return;
                }

                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/api/event/update/' + eventId, 
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            window.location.href = '{{ url("/index") }}';
                        } else {
                            $('#response').html('<div class="alert alert-danger">Error updating event.</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#response').html('<div class="alert alert-danger">Error: ' + xhr.responseJSON.message + '</div>');
                    }
                });
            });
        });
    </script>

</body>

</html>
