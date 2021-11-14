@extends('admin.template')
@section('title', 'Edit Article')

@section('content')

<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
  <li class="breadcrumb-item"><a href="{{route('admin.showArticles')}}">Articles</a></li>
  <li class="breadcrumb-item active">Edit article</li>
</ol>

<div class="card p-3">
    <form action="{{route('admin.updateArticles', $page->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('put')

        <div class="row">
            <div class="col-md-9">
                <h4 class="p-2 text-dark" style="background-color: #e9ecef">Content</h4>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputTitle">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputTitle" placeholder="Article name" name="title" value="{{old('title') ? old('title') : $page->title}}">
                            @error('title') <span class="text-danger small">{{$message}}</span> @enderror 
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputSlug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="inputSlug" placeholder="Slug page address"  name="slug" value="{{old('slug') ? old('slug') : $page->slug}}">
                            @error('slug') <span class="text-danger small">{{$message}}</span> @enderror 
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputSubtitle">Subtitle</label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="inputSubtitle" placeholder="The subtitle of the new article"  name="subtitle" value="{{old('subtitle') ? old('subtitle') : $page->subtitle}}">
                            @error('subtitle') <span class="text-danger small">{{$message}}</span> @enderror 
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="inputExcerpt">Excerpt</label>
                                <textarea rows="5" class="form-control @error('excerpt') is-invalid @enderror" id="inputExcerpt" name="excerpt" >{{old('excerpt') ? old('excerpt') : $page->excerpt}}</textarea>
                                @error('excerpt') <span class="text-danger small">{{$message}}</span> @enderror 
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPresentation">Presentation</label>
                                <textarea rows="5" class="form-control @error('presentation') is-invalid @enderror" id="inputPresentation" name="presentation" >{{old('presentation') ? old('presentation') : $page->presentation}} </textarea>
                                @error('presentation') <span class="text-danger small">{{$message}}</span> @enderror 
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputContent">Content</label>
                                <textarea rows="5" class="form-control @error('content') is-invalid @enderror" id="inputContent" name="content" >{{old('content') ? old('content') : $page->content}}</textarea>
                                @error('content') <span class="text-danger small">{{$message}}</span> @enderror 
                        </div>


                    </div>
            </div>

            <div class="col-md-3">
                <h4 class="p-2 text-dark" style="background-color: #e9ecef">Article admin</h4>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputMetaTitle">Meta title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="inputMetaTitle" placeholder="Article meta title tag" name="meta_title" value="{{old('meta_title') ? old('meta_title') : $page->meta_title}}">
                        @error('meta_title') <span class="text-danger small">{{$message}}</span> @enderror 
                      </div>
                      <div class="form-group col-md-12">
                        <label for="inputMetaDescription">Meta description</label>
                        <input type="text" class="form-control @error('meta_description') is-invalid @enderror" id="inputMetaDescription" placeholder="Article meta description tag"  name="meta_description" value="{{old('meta_description') ? old('meta_description') : $page->meta_description}}">
                        @error('meta_description') <span class="text-danger small">{{$message}}</span> @enderror 
                      </div>
                      <div class="form-group col-md-12">
                        <label for="inputMetaKeywords">Meta keywords</label>
                        <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="inputMetaKeywords" placeholder="Article meta keywords tag"  name="meta_keywords" value="{{old('meta_keywords') ? old('meta_keywords') : $page->meta_keywords}}">
                        @error('meta_keywords') <span class="text-danger small">{{$message}}</span> @enderror 
                      </div>

                      <div id="img-preview">
                        <img class="photo-preview" src="/admin/images/articles/{{ $page->photo }}" alt="" style="display:inline-block;max-width:200px;">
                      </div>

                      <div class="custom-file mt-4 mb-3 col-md-12">
                        <input type="file" accept="image/*" class="custom-file-input  @error('photo') is-invalid @enderror" id="choose-file" accept="image/*" name="photo">
                        <label class="custom-file-label" for="choose-file">Choose photo</label>
                        @error('photo') <span class="text-danger small">{{$message}}</span> @enderror 
                      </div>

                      <div class="form-group m-4 text-info">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck" value="1" name="publish" {{isset($page->published_at) ? 'checked' : ''}}>
                          <label class="form-check-label" for="gridCheck">
                            Publish
                          </label>
                        </div>
                      </div>

                      <div class="form-group col-md-12">
                        <label for="inputView">View</label>
                        <input type="number" defaultValue="0" min="0" class="form-control @error('view') is-invalid @enderror" id="inputView" placeholder="Number of views"  name="view" value="{{old('view') ? old('view') : $page->view}}">
                        @error('view') <span class="text-danger small">{{$message}}</span> @enderror 
                      </div>

                      <div class="form-group col-md-12">
                        <label for="inputPublished">Date of publishing<br>
                          <span class="text-info">{{ isset($page->published_at) ? $page->published_at->format('d M Y') : 'Unpublished'}}</span></label>
                        <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="inputPublished" name="published_at" value="{{$page->published_at ? $page->published_at->format('Y-m-d') : date('Y-m-d')}}">
                        @error('published_at') <span class="text-danger small">{{$message}}</span> @enderror 
                      </div>

                      @if(isset($authors))
                        <div class="form-group col-md-12">
                          <label for="inputPublishedBy">Published by</label>
                          <select class="custom-select @error('published_by') is-invalid @enderror" id="inputPublishedBy" name="published_by" value="{{old('published_by')}}">
                            
                            @foreach($authors as $author)
                              <option {{ $author->id == $page->user_id ? 'selected' : ''}} value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach

                          </select>
                          @error('published_by') <span class="text-danger small">{{$message}}</span> @enderror 
                        </div>
                      @else
                      <div class="form-group col-md-12 mt-4">
                        <p>Published by: <span class="text-primary">{{ auth()->user()->name }}</span></p> 
                      </div>
                      @endif
                </div>

            <button type="submit" class="btn btn-primary float-right mt-3">Save</button>
            <a href="{{route('admin.showArticles')}}" type="submit" class="btn btn-secondary float-right mr-2  mt-3">Cancel</a>
          
          </div>
        </div>  

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
  CKEDITOR.replace( 'inputContent' );
  CKEDITOR.replace( 'inputPresentation' );
</script>

@endsection