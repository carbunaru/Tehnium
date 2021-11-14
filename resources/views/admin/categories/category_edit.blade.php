@extends('admin.template')
@section('title', 'Edit Category - '.ucfirst($category->title))

@section('content')

<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
  <li class="breadcrumb-item"><a href="{{route('admin-categories')}}">Catgories</a></li>
  <li class="breadcrumb-item active">Edit category</li>
</ol>

<div class="card p-3">
    <form action="{{route('admin-updateCategoryForm', $category->id)}}" method="POST" enctype="multipart/form-data">
      @method('put')
      @csrf
      <div id="img-preview">
        <img class="photo-preview" src="/admin/images/categories/{{ $category->photo }}" alt="" style="display:inline-block;max-width:200px;">
      </div>

        <div class="form-row mt-4">
            <div class="form-group col-md-2">
                <label for="inputTitle">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputTitle" placeholder="Category name" name="title" value="{{old('title') ? old('title') : $category->title}}">
                @error('title') <span class="text-danger small">{{$message}}</span> @enderror 
            </div>
            <div class="form-group col-md-8">
                <label for="inputSubtitle">Subtitle</label>
                <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="inputSubtitle" placeholder="The subtitle of the new category"  name="subtitle" value="{{old('subtitle') ? old('subtitle') : $category->subtitle}}">
                @error('subtitle') <span class="text-danger small">{{$message}}</span> @enderror 
            </div>
            <div class="form-group col-md-2">
                <label for="inputSlug">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="inputSlug" placeholder="Slug page address"  name="slug" value="{{old('slug') ? old('slug') : $category->slug}}">
                @error('slug') <span class="text-danger small">{{$message}}</span> @enderror 
            </div>        
        </div>
      
        <div class="form-row">
          <div class="form-group col-md-10">
            <label for="inputExcerpt">Excerpt</label>
            <textarea rows="5" class="form-control @error('excerpt') is-invalid @enderror" id="inputExcerpt" name="excerpt" >{{old('excerpt') ? old('excerpt') : $category->excerpt}}</textarea>
            @error('excerpt') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
          <div class="form-group col-md-2">
                
                <div class="form-group">
                    <label for="inputView">View</label>
                    <input type="number" defaultValue="0" min="0" class="form-control @error('view') is-invalid @enderror" id="inputView" placeholder="Number of views"  name="view" value="{{old('view') ? old('view') : $category->view}}">
                    @error('view') <span class="text-danger small">{{$message}}</span> @enderror 
                </div>
                <div class="form-group">
                    <label for="inputPosition">Position</label>
                    <input type="number" class="form-control @error('position') is-invalid @enderror" id="inputPosition" placeholder="Display position"  name="position" value="{{old('position') ? old('position') : $category->position}}">
                    @error('position') <span class="text-danger small">{{$message}}</span> @enderror 
                </div>
                <div class="custom-file mt-4 mb-3">
                  <input type="file" class="custom-file-input  @error('photo') is-invalid @enderror" id="choose-file" accept="image/*" name="photo">
                  <label class="custom-file-label" for="choose-file">Choose photo</label>
                  @error('photo') <span class="text-danger small">{{$message}}</span> @enderror 
                </div>
                <div class="form-group m-4 text-info">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck" value="1" name="publish" {{ $category->publish==1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="gridCheck">
                      Publish
                    </label>
                  </div>
                </div>
            </div>
        </div>
        <div class="form-row bg-light py-2">
            <div class="form-group col-md-2">
              <label for="inputMetaTitle">Meta title</label>
              <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="inputMetaTitle" placeholder="Category meta title tag" name="meta_title" value="{{old('meta_title') ? old('meta_title') : $category->meta_title}}">
              @error('meta_title') <span class="text-danger small">{{$message}}</span> @enderror 
            </div>
            <div class="form-group col-md-8">
              <label for="inputMetaDescription">Meta description</label>
              <input type="text" class="form-control @error('meta_description') is-invalid @enderror" id="inputMetaDescription" placeholder="Category meta description tag"  name="meta_description" value="{{old('meta_description') ? old('meta_description') : $category->meta_description}}">
              @error('meta_description') <span class="text-danger small">{{$message}}</span> @enderror 
            </div>
            <div class="form-group col-md-2">
              <label for="inputMetaKeywords">Meta keywords</label>
              <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="inputMetaKeywords" placeholder="Category meta keywords tag"  name="meta_keywords" value="{{old('meta_keywords') ? old('meta_keywords') : $category->meta_keywords}}">
              @error('meta_keywords') <span class="text-danger small">{{$message}}</span> @enderror 
            </div>
        </div>

      <br>
      <button type="submit" class="btn btn-primary float-right">Save</button>
      <a href="{{route('admin-categories')}}" type="submit" class="btn btn-secondary float-right mr-2">Cancel</a>

    </form>
</div>    

@endsection

@section('customJS')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script>
  $(document).ready(function () {
  bsCustomFileInput.init()
})
</script>
<script>
  const chooseFile = document.getElementById("choose-file");
  const imgPreview = document.getElementById("img-preview");

  chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" style="display:inline-block;max-width:200px;" />';
    });    
  }
}

</script>

<script>

$('#inputTitle').on('blur',function(){

  var theTitle=this.value.toLowerCase().trim(),
      slugInput=$('#inputSlug'),
      theSlug=theTitle.replace(/&/g,'-and-')
          .replace(/[^a-z0-9-]+/g,'-')
          .replace(/\-\-+/g,'-')
          .replace(/^-+|-+$/g,'');

  slugInput.val(theSlug);
});

</script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'inputExcerpt' );
</script>

@endsection