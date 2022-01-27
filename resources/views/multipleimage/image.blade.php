<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <br><br><br>
    <div class="container col-8 bg-light mt-4"><br>
        <h2>Multiple Image Upload</h2><br><br>
        @if(Session::has('msg'))
        <div class="text-success font-weight-bold" class="container">{{Session::get('msg')}}</div>
        @endif

       <form action="sendimage" method="post" enctype="multipart/form-data">
           @csrf()
           <div class="form-group">
             <label>Upload Image</label>
             <input type="file" name="image[]" class="form-control container" multiple>
             @if($errors->has('image'))
             <div class="text-danger font-weight-bold" class="container">{{$errors->first('image')}}</div>
             @endif
           </div><br>
           <div class="form-group mt-4">
             <input type="submit" name="sub" value="Upload" class="btn btn-success col-4">
           </div><br><br>
       </form>
    </div><br><br>

    <div class="mt-4">
      @foreach($data as $d)
            <img src="{{('/uploads/'.$d->image)}}" alt="no image" height="50" width="50">
           @endforeach
    </div>
</body>
</html>