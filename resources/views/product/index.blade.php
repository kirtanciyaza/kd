<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product table</title>
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
        <p><a href="{{ route('product.create') }}" class="btn btn-primary">Create New Product</a></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>click to download qr</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{!! $item->desc !!}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                            @foreach ($item->images as $img)
                                <img src="{{ asset('images/' . $img->image) }}" alt="Product Image"
                                    style="width:100px;height:auto;">
                            @endforeach
                        </td>
                        <td>
                            @if ($item->status === 'Yes')
                                <!-- Success SVG Icon -->
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm-1.708 17.75L4.5 12.042l1.417-1.417 4.583 4.583 9.583-9.583L21 7.75l-9.708 9.708z"
                                        fill="#28a745" />
                                </svg>
                            @else
                                <!-- Unsuccess SVG Icon -->
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm-1.293 15.293L7.707 12l-1.414-1.414L10.293 9l-1.293-1.293L6.293 12l-2.293 2.293 1.414 1.414L9 13.414l2.293 2.293 1.414-1.414zm2.586-2.586L12 13.414l-2.293-2.293 1.414-1.414L12 10.586l2.293-2.293 1.414 1.414L13.414 12z"
                                        fill="#dc3545" />
                                </svg>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('product.qrcode', $item->id) }}" class="btn btn-warning">click to
                                download qr</a>
                        </td>

                        <td>
                            <form action="{{ route('product.delete', $item->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <a href="{{ route('product.show', $item->id) }}" class="btn btn-success">SHOW</a>
                                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info">EDIT</a>
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
