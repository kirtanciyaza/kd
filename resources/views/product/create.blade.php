 @extends('product.layout')

 @section('contect')

<div class="container">
  <h2>Create product form</h2>
  <p><a href="{{ route('product.index') }}" class="btn btn-primary" > BACK</a></p>
  <form class="form-horizontal" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label class="control-label col-sm-2" for="name">name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
      </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="desc">desc:</label>
        <div class="col-sm-10">
            <textarea name="desc" id="desc" class="summernote"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="images">images:</label>
        <div class="col-sm-10">
          <input type="file" class="form-control" id="images[]"  name="images[]" multiple>
        </div>
    </div>


    <div class="form-group">
      <label class="control-label col-sm-2" for="price">price:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="price" placeholder="Enter price" name="price">
      </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="status">Status:</label>
      <div class="col-sm-10">
        <select class="form-control" name="status">
            <option value="Default">Default</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </form>
</div>



@endsection




