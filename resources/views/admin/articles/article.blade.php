@extends('admin.template') 
@if(isset($author_name))
    @section('title', 'Manage Articles for '.$author_name)
@elseif(isset($published_title))
@section('title', 'Manage'.$published_title.'Articles')
@elseif(isset($cat_title))
@section('title', 'Managea articles from '.$cat_title.' category')
@else
    @section('title', 'Manage Articles')
@endif

@section('content')

                    
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
                            <li class="breadcrumb-item 
                                @if(!isset($cat_title)) 
                                    active">Articles</li>
                                @else
                                    "><a href="{{route('admin.showArticles')}}">Articles</a></li>
                                @endif
                            
                            @if(isset(($cat_title)))
                            <li class="breadcrumb-item active">{{ $cat_title }}</li>
                            @endif
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <i class="fas fa-table me-1"></i>
                                        Articles ({{$pages->total()}})
                                    </div>
                                    <div class="col-md-6">
                                        @can('author-rights')
                                        
                                        <a href="{{ route('admin.newArticles') }}" class="btn btn-success float-right">New Article</a>
                                        @if(isset($author_name) || isset($published_title))
                                            <a href="{{ route('admin.showArticles') }}" class="btn btn-success float-right mr-2">All Articles</a>
                                        @endif
                                        @endcan
                                    </div>
                                </div><br>
                                <div class="row">                                   
                                    @if($pages->count()>0)
                                        <div class="col-md-4">Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} entries</div>
                                        <div class="col-md-4"><i class="fas fa-filter"></i> Categories: 
                                            @foreach($categories as $category)
                                            <a href="{{ route('admin.showArticles',['categories'=>$category->id]) }}" class="badge badge-primary p-2"> {{ $category->title }}</a>
                                            @endforeach
                                        </div>
                                        <div class="col-md-4"><span class="float-right">{{ $pages->links() }}</span></div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                    <table class="table">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" title="Published/Draft"><i class="fas fa-book-reader"></i></th>
                                            <th class="col-md-2" scope="col">@sortablelink('title', 'Title') / @sortablelink('created_at', 'Created')</th>
                                            <th class="col-md-2" scope="col">Author</th>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Subtitle</th>                                       
                                            <th scope="col" class="col-md-1">@sortablelink('view', 'Views')</th>
                                            <th scope="col">Description / Categories</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach($pages as $page)
                                            <tr class="border-white">
                                                <td>
                                                    @if(isset($page->published_at))
                                                        <a href="{{ route('admin.showArticles',['published'=>1]) }}" title="Published articles"><i class="fas fa-book-reader text-success"></i></a>
                                                    @else
                                                    <a href="{{ route('admin.showArticles',['published'=>2]) }}" title="Draft articles"><i class="fas fa-bookmark text-danger"></i></a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ ucfirst($page->title) }}</strong><br>
                                                    {{ $page->created_at->format('D j F Y h:i') }}
                                                    
                                                </td>
                                                <td>
                                                    @if(!isset($author_name))
                                                        <a class="text-hover text-dark"  href="{{ route('admin.showArticles', ['author'=>$page->author->id]) }}">{{ $page->author->name }} </a>&nbsp;&nbsp;<span class="badge badge-success">  {{ $page->author->articles->count() }}</span>
                                                    @else
                                                        {{ $page->author->name }}
                                                    @endif
                                                </td>
                                                <td><img class="user-avatar" src="/admin/images/articles/{{$page->photo}}">
                                                </td>
                                                <td>{{ $page->subtitle }}</td>                                          
                                                <td>{{ $page->view }}</td>
                                                <td>{{ ucfirst($page->meta_description) }}<br>
                                                    @foreach($page->categories as $category)
                                                        <span class="badge badge-primary p-1"> {{ $category->title }}</span>
                                                    @endforeach
                                                </td>    
                                                
                                                
                                            </tr>
                                            <tr class="border-0">
                                                <td colspan="8"> 
            
                                                    <form id="form-delete-{{$page->id}}" action="{{ route('admin.deleteArticles',$page->id)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>

                                                    <button type="button" class="btn btn-danger btn-circle btn-md d-inline float-right confirm ml-1" title="Delete article"
                                                    
                                                        onclick="if(confirm('Are you sure you want to delete this article: {{$page->title}}?')){
                                                            document.getElementById('form-delete-{{$page->id}}').submit();
                                                        }"
                                                    
                                                    ><i class="fas fa-2x fa-trash"></i></button>

                                                    <span class="badge badge-success float-right">  {{ $page->categories()->count() }}</span><a href="{{ route('admin.showCategoriesArticles',$page->id) }}" class="btn btn-success btn-circle btn-md d-inline float-right ml-1" title="Add category"><i class="fas fa-2x fa-list-ul m-1"></i></a>
                                                    <span class="badge badge-success float-right">  {{ $page->photos()->total() }}</span><a href="{{ route('admin.showFormPhotos',$page->id) }}" class="btn btn-success btn-circle btn-md d-inline float-right ml-1" title="Add gallery"><i class="fas fa-2x fa-camera m-1"></i></a>
                                                    <span class="badge badge-success float-right">  {{ $page->messages()->total() }}</span><a href="{{ route('admin.showComments',$page->id) }}" class="btn btn-success btn-circle btn-md d-inline float-right ml-1" title="See comments"><i class="far fa-2x fa-comment-dots m-1"></i></a>
                                                    <a href="{{ route('admin.editArticles',$page->id) }}" class="btn btn-success btn-circle btn-md d-inline float-right ml-1" title="Edit article"><i class="fas fa-2x fa-pencil-alt m-1"></i></a>
                                                    
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        
                                    </table>
                                
                            </div>
                            <div class="card-footer">
                                <div class="float-left">Showing {{ $pages->firstItem() }} to {{ $pages->lastItem() }} of {{ $pages->total() }} entries</div>
                                <div class="float-right">{{ $pages->links() }}</div>
                            </div>
                            @else
                                <div class="alert alert-warning">There are no articles for this author!</div>
                            @endif
                        </div>
                                     
@endsection
