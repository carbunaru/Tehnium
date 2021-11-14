@extends('admin.template') 
@section('title', 'Set categories')
@section('content') 

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.showArticles')}}">Articles</a></li>
    <li class="breadcrumb-item active">Set categories</li>
</ol>
  <!-- Card -->
  <div class="card">
    <h5 class="card-header">Add categories for <span class="text-info font-italic">'{{ $page->title }}'</span> article: </h5>
    <div class="card-body">
        <form action="{{route('admin.setCategoriesArticles',$page->id)}}" method="POST"> 
            @csrf
            @method('put')
            @foreach($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categs[]" id="check-{{ $category->id }}" value="{{ $category->id }}" {{$page->categories()->find($category->id) ? 'checked' : ''}}>
                        <label class="form-check-label" for="check-{{ $category->id }}">
                        {{ $category->title }}
                        </label>
                    </div>
            @endforeach
    
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Save</button>        
                <a href="{{route('admin.showArticles')}}" type="button" class="btn btn-secondary float-right mr-2">Close</a>
                
        </div>
        </form>
    </div>
  

@endsection  