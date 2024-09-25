<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product Table</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/buds.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Product Table</h2>
        <p><a href="{{ route('event.create') }}" class="btn btn-primary">Create New Event</a></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Video</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{!! $item->desc !!}</td>
                        <td>
                            @if($item->image)
                                @php
                                    $images = json_decode($item->image);
                                @endphp
                                @foreach($images as $image)
                                    <img src="{{ asset($image) }}" alt="Event Image" style="width: 100px; height: auto; margin-right: 10px;">
                                @endforeach
                            @else
                                No images available
                            @endif
                        </td>
                        <td>
                            @if($item->video)
                                <video width="300" height="150" controls>
                                    <source src="{{ asset($item->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                No video available
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('event.edit', $item->id) }}" class="btn btn-warning btn-xs">Edit</a>
                            <form action="{{ route('event.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
