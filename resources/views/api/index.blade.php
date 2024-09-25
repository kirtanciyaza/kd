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
        <p><a href="{{ route('qqq.create') }}" class="btn btn-primary">Create New Event</a></p>
        <table class="table" id="eventTable">
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
            <tbody></tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            var token = localStorage.getItem('token');

            if (!token) {
                console.error('Token not found!');
                return;
            }

            $.ajaxSetup({
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        
            $.ajax({
                url: '/api/event/index',
                method: 'GET',
                success: function(response) {
                    if (response.status) {
                        var rows = '';
                        $.each(response.data, function(index, item) {
                            rows += '<tr>';
                            rows += '<td>' + item.title + '</td>';
                            rows += '<td>' + item.name + '</td>';
                            rows += '<td>' + item.desc + '</td>';
                            rows += '<td>';
                            if (item.image) {
                                var images = JSON.parse(item.image);
                                $.each(images, function(i, image) {
                                    rows += '<img src="' + image + '" alt="Image for ' + item.title + '" style="width: 100px; height: auto; margin-right: 10px;">';
                                });
                            } else {
                                rows += 'No images available';
                            }
                            rows += '</td>';
                            rows += '<td>';
                            if (item.video) {
                                rows += '<video width="120" height="90" controls>' +
                                        '<source src="' + item.video + '" type="video/mp4">' +
                                        'Your browser does not support the video tag.' +
                                        '</video>';
                            } else {
                                rows += 'No video available';
                            }
                            rows += '</td>';
                            rows += '<td>' +
                                '<a href="edit/' + item.id + '" class="btn btn-warning btn-xs">Edit</a>' +
                                '<button class="btn btn-danger btn-xs" onclick="deleteEvent(' + item.id + ')">Delete</button>' +
                                '</td>';
                            rows += '</tr>';
                        });
                        $('#eventTable tbody').html(rows);
                    } else {
                        alert('No data found.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error fetching data. Please try again later.');
                    console.error('Error fetching data:', error);
                }
            });
        });

        function deleteEvent(id) {
            if (confirm('Are you sure you want to delete this event?')) {
                var token = localStorage.getItem('token');

                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/api/event/destroy/' + id,
                    method: 'DELETE',
                    success: function(response) {
                        if (response.status) {
                            alert('Event deleted successfully!');
                            location.reload();
                        } else {
                            alert('Error deleting event.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting event. Please try again later.');
                        console.error('Error deleting event:', error);
                    }
                });
            }
        }
    </script>

</body>

</html>
