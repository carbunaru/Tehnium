@extends('admin.template') 
@section('title', 'Manage Comments')

@section('content')

                    
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.showArticles')}}">Articles</a></li>
                            <li class="breadcrumb-item active">Comments for 
                                @if (isset($author_name))
                                    <strong>{{ $author_name }}</strong> 
                                @else
                                    <strong>'{{ $page->title }}'</strong></li>
                                @endif
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <i class="fas fa-table me-1"></i>
                                        Comments ({{$messages->total()}})
                                    </div>
                                <div class="row mt-2">                                   
                                    @if($messages->count()>0)
                                        <div class="col-md-4">Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} entries</div>
                                        <div class="col-md-4"><span class="float-right">{{ $messages->links() }}</span></div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                @if (isset($author_name))
                                                    <th scope="col">Article</th>
                                                @endif
                                                <th class="col-md-3" scope="col">
                                                        @sortablelink('title', 'Title') / @sortablelink('created_at', 'Created')
                                                </th>                                 
                                                <th class="col-md-4" scope="col">Content</th>
                                                <th class="col-md-2" scope="col">Author</th>
                                                <th class=" text-right" scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach($messages as $message)
                                            <tr>
                                                @if (isset($author_name))
                                                    <td><strong><a class="text-dark" href="{{ route('admin.showComments',['id'=>$message->mess_article->id]) }}">{{ $message->mess_article->title }}</a></strong></td>
                                                @endif
                                                <td>
                                                    {{ucfirst($message->title)}}<br> 
                                                    
                                                    {{ $message->created_at->format('D j F Y h:i') }}
                                                </td>                                                                                              
                                                <td>{{ ucfirst($message->content) }}</td> 
                                                <td>
                                                    @if (isset($author_name))
                                                        <strong>{{ $author_name }}</strong>
                                                    @else
                                                        <strong><a class="text-hover text-dark"  href="{{ route('admin.showComments', ['id'=>$page->id,'author'=>$message->mess_author->id]) }}">{{ $message->mess_author->name }} </a></strong>&nbsp;&nbsp;<span class="badge badge-success">  {{ $message->mess_author->comments->count() }}</span>
                                                    @endif
                                                        
                                                </td>
                                                <td>
                                                    <form id="form-delete-{{$message->id}}" action="{{ route('admin.deleteComment',$message->id)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-circle btn-md d-inline float-right confirm ml-1" title="Delete article"
                                                    
                                                        onclick="if(confirm('Are you sure you want to delete this comment?')){
                                                            document.getElementById('form-delete-{{$message->id}}').submit();
                                                        }"
                                                    
                                                    ><i class="fas fa-2x fa-trash"></i></button>
                                                </td>       
                                            </tr>
                                            {{-- <tr class="border-0">
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
                                                    <span class="badge badge-success float-right">  {{ $messages->total() }}</span><a href="{{ route('admin.showComments',$page->id) }}" class="btn btn-success btn-circle btn-md d-inline float-right ml-1" title="See comments"><i class="far fa-2x fa-comment-dots m-1"></i></a>
                                                    <a href="{{ route('admin.editArticles',$page->id) }}" class="btn btn-success btn-circle btn-md d-inline float-right ml-1" title="Edit article"><i class="fas fa-2x fa-pencil-alt m-1"></i></a>
                                                    
                                                </td>
                                            </tr> --}}
                                        @endforeach

                                        </tbody>
                                        
                                    </table>
                                
                            </div>
                            <div class="card-footer">
                                <div class="float-left">Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} entries</div>
                                <div class="float-right">{{ $messages->links() }}</div>
                            </div>
                            @else
                                <div class="alert alert-warning">There are no articles for this author!</div>
                            @endif
                        </div>
                                     
@endsection
