@extends('admin.template')
@section('title', 'Add Gallery')

@section('customCSS')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css">
<link href="/admin/assets/gallery/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="/admin/assets/gallery/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="/admin/assets/gallery/magnific.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
  <li class="breadcrumb-item"><a href="{{route('admin.showArticles')}}">Articles</a></li>
  <li class="breadcrumb-item"><a href="{{route('admin.editArticles',$page->id)}}">{{ $page->id }}</a></li>
  <li class="breadcrumb-item active">Add Gallery for <span class="text-info">'{{ $page->title }}'</span></li>
</ol>

@if(count($errors)>0)
      <div class="alert alert-danger mt-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
      </div>
 @endif

<div class="card p-4">
    <h2>Select images for photo gallery <small class="text-muted">(maximum 8 images/upload)</small> :</h2>
    <form action="{{ route('admin.uploadPhotos',$page->id) }}" method="POST" enctype="multipart/form-data" accept="image/*">
      @csrf
        <div class="row">
            <div class="col">
                <input id="photo" name="photo[]" type="file" class="file" multiple 
                data-show-upload="true" data-show-clear="true" data-show-remove="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
            </div>
        </div>
    </form>
    <div class="row">
      <div class="col-md-6">
        <h2 class="mt-4">Gallery ({{ $page->photos()->total() }})</h2>
      </div>
      @if($page->photos()->count()>0)
        <div class="col-md-6 mt-4">
          <form id="form-delete-all" action="{{ route('admin.deleteAllPhotos',$page->id) }}" method="post">
            @csrf
            @method('delete')
          </form>
          <button type="submit" class="btn btn-danger float-right" onclick="if(confirm('Are you sure you want to delete this gallery?')){document.getElementById('form-delete-all').submit();}"><i class="far fa-trash-alt"></i> Delete all</button>
          <a href="{{route('admin.editArticles',$page->id)}}"><button type="submit" class="btn btn-primary float-right mr-2"><i class="fas fa-pencil-alt"></i> Edit article</button><a>
        </form>
        </div>
        
      @endif
  </div>
    <div class="row">
      @foreach($page->photos() as $photo)
        <div class="col-md-3 d-flex flex-column justify-content-between">
          <a class="magnific-gallery" href="{{ $photo->photo_url() }}">
            <span class="badge badge-secondary badge_position">{{ request('page') ? $loop->iteration + $page->photos()->perPage() * (request('page')-1) : $loop->iteration }}</span>
            <img class="photo" src="{{ $photo->photo_url() }}" alt="">
          </a>
          <form action="{{ route('admin.updatePhoto',$photo->id) }}" method="POST" enctype="multipart/form-data" accept="image/*">
            @csrf
            @method('put')

            <div class="row">
              <div class="col-md-12 mt-2">
                <input type="text" id="title" class="form-control" placeholder="Image title"  name="title" value="{{$photo->title}}"> 
              </div>
              <div class="col-md-12 mt-2">
                <input type="text" id="description" class="form-control" placeholder="Image description"  name="description" value="{{$photo->description}}"> 
              </div>
              <div class="col-md-6 mt-2">
                <input type="number" id="position" class="form-control" placeholder="Image position"  name="position" value="{{$photo->position}}"> 
              </div>
              <div class="col-md-6 mt-2">
                <div class="m-2"><input class="form-check-input" type="checkbox" id="publish" value="1" name="publish" {{$photo->publish==1 ? 'checked' : ''}}>Published image</div>
              </div>
              <div class="custom-file col-md-12 mt-2">
                <input type="file" accept="image/*" class="custom-file-input" id="choose-file" name="photo">
                <label class="custom-file-label" style="margin:auto 12px;" for="choose-file">Choose photo</label> 
              </div>
              <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-upload"></i> Update</button>
              </div>
              <div class="col-md-12 mt-2">
                <form id="form-photo-{{ $photo->id }}" action="{{ route('admin.deletePhoto',$page->id) }}" method="post">
                  @csrf
                  @method('delete')
                </form>
                <button type="submit" class="btn btn-danger btn-block" onclick="if(confirm('Are you sure you want to delete this image?')){document.getElementById('form-photo-{{ $photo->id }}').submit();}"><i class="far fa-trash-alt"></i> Delete</button>
              </div>
              
            </div>
          </form>
        </div>
      @endforeach
    </div>
<div class="gallery_link ">{{ $page->photos()->links() }}</div>
</div>



@endsection

@section('customJS')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/admin/assets/gallery/bootstrap.bundle.min.js"></script>
<script src="/admin/assets/gallery/fileinput.min.js"></script>
<script src="/admin/assets/gallery/magnific.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
  $(document).ready(function () {
  bsCustomFileInput.init();

  $('.magnific-gallery').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
		
	});
  
  })


</script>

@endsection