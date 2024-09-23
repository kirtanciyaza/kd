<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>edit product</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{ asset('img/buds.jpeg') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  </head>
  <body>

<div class="container">
 <h2>edit product form</h2>
 <p><a href="{{ route('product.index') }}" class="btn btn-primary">BACK</a></p>
 <form class="form-horizontal" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
   @csrf
   @method('PUT')

   <div class="form-group">
     <label class="control-label col-sm-2" for="name">Name:</label>
     <div class="col-sm-10">
       <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
     </div>
   </div>

   <div class="form-group">
       <label class="control-label col-sm-2" for="desc">Description:</label>
       <div class="col-sm-10">
           <textarea name="desc" id="desc" class="summernote"> {!! $product->desc !!}</textarea>
       </div>
   </div>

   <div class="form-group">
       <label class="control-label col-sm-2" for="images">Images:</label>
       <div class="col-sm-10">
         <input type="file" class="form-control" id="images[]" name="images[]" multiple>
       </div>
       <div class="col-sm-10 col-sm-offset-2">
         @foreach ($product->images as $img)
           <div class="image-preview">
             <img src="{{ asset('images/' . $img->image) }}" alt="Product Image" style="width:100px;height:auto;">
             <label><input type="checkbox" name="delete_images[]" value="{{ $img->id }}"> Delete</label>
           </div>
         @endforeach
       </div>
   </div>

   <div class="form-group">
     <label class="control-label col-sm-2" for="price">Price:</label>
     <div class="col-sm-10">
       <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="{{ $product->price }}">
     </div>
   </div>

   <div class="form-group">
    <label class="control-label col-sm-2" for="cmp">compare price:</label>
    <div class="col-sm-10">
        @foreach ($product->art as $cms)
      <input type="number" class="form-control" id="cmp" placeholder="Enter compare price" name="cmp" value="{{ $cms->cmp }}">
      @endforeach
    </div>
    </div>

   <div class="form-group">
       <label class="control-label col-sm-2" for="status">Status:</label>
     <div class="col-sm-10">
       <select class="form-control" name="status">

           <option value="Yes" {{ $product->status == 'Yes' ? 'selected' : '' }}>Yes</option>
           <option value="No" {{ $product->status == 'No' ? 'selected' : '' }}>No</option>
       </select>
     </div>
   </div>

   <div class="form-group">
     <div class="col-sm-offset-2 col-sm-10">
       <button type="submit" class="btn btn-success">Update</button>
     </div>
   </div>
 </form>
</div>


<script>
    $('.summernote').summernote({
      tabsize: 2,
      height: 100
    });
</script>
</body>
</html>
