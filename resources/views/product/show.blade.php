<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>show Product</h2>

        <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                    @foreach ($product->images as $img)
                    <img src="{{ asset('images/' . $img->image) }}" alt="Product Image" style="width:100px;height:auto;">
                    @endforeach
                  <h5 class="card-title">NAME: {{ $product->name }}</h5>
                  <p class="card-text">Descption: {!! $product->desc !!}</p>
                  <p class="card-price">Price: {{ $product->price }}</p>
                  <p class="card-status">
                    status:
                    @if ($product->status === 'Yes')
                    <!-- Success SVG Icon -->
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm-1.708 17.75L4.5 12.042l1.417-1.417 4.583 4.583 9.583-9.583L21 7.75l-9.708 9.708z" fill="#28a745"/>
                    </svg>
                @else
                    <!-- Unsuccess SVG Icon -->
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm-1.293 15.293L7.707 12l-1.414-1.414L10.293 9l-1.293-1.293L6.293 12l-2.293 2.293 1.414 1.414L9 13.414l2.293 2.293 1.414-1.414zm2.586-2.586L12 13.414l-2.293-2.293 1.414-1.414L12 10.586l2.293-2.293 1.414 1.414L13.414 12z" fill="#dc3545"/>
                    </svg>
                @endif

                  </p>
                  <a href="{{ route('product.index') }}" class="btn btn-primary">Go BACK</a>
                </div>
              </div>
            </div>
        </div>

    </div>

</body>

</html>
