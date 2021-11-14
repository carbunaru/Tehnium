@extends('admin.template')
@section('title', 'Manage Categories')
@section('content')

                    
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Categories ({{$categories->count()}})
                                @can('author-rights')
                                <a href="{{ route('admin-newCategoryForm') }}" class="btn btn-success float-right">New Category</a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Public</th>
                                            <th>Pos.</th>
                                            <th>Title / Created</th>
                                            <th>Subtitle</th>
                                            <th>Photo</th>
                                            <th>View</th>
                                            <th>Meta title</th>
                                            <th>Meta Description / Keywords</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td class="text-center">{!! $category->publish==1 ? '<i class="fa fa-eye text-success"></i>' : '<i class="fa fa-eye-slash text-danger"></i>' !!}</td>
                                            <td class="text-center">{{$category->position}}</td>
                                            <td class="col-md-2"><a class="text-hover text-dark" href="{{ route('admin.showArticles',['categories'=>$category->id]) }}"><strong>{{ ucfirst($category->title) }}</strong>&nbsp;&nbsp;<span class="badge badge-success">  {{ $category->pages->count() }}</span></a><br><br>
                                            {{$category->created_at->format('D j F Y h:i') }}
                                        </td>
                                            <td>{{$category->subtitle}}</td>
                                            <td><img class="user-avatar" src="/admin/images/categories/{{ $category->photo }}" alt="No photo"></td>
                                            <td>{{$category->view}}</td>
                                            <td class="col-md-1">{{$category->meta_title}}</td>
                                            <td>{{$category->meta_description}}<br><br>
                                                <span class="text-info">{{str_replace(', ', ' | ', $category->meta_keywords)}}</span> 
                                            </td>
                                            <td @can('admin-rights') class="col-md-1" @endcan>
                                                <a href="{{ route('admin-editCategoryForm', $category->id) }}"><button class="btn btn-success btn-circle btn-md" title="Edit category"><i class="fas fa-2x fa-pencil-alt m-1"></i></button></a>
                                            

                                            @can('admin-rights')
                                                <form id="form-delete-{{$category->id}}" action="{{ route('admin-deleteCategoryForm', $category->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('delete')
                                                </form>

                                                <button type="button" class="btn btn-danger btn-circle btn-md confirm" title="Delete category"
                                                
                                                    onclick="if(confirm('Are you sure you want to delete this category: {{$category->title}}?')){
                                                        document.getElementById('form-delete-{{$category->id}}').submit();
                                                    }"
                                                
                                                ><i class="fas fa-2x fa-trash"></i></button>
                                            @endcan

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Public</th>
                                            <th>Pos.</th>
                                            <th>Title / Slug</th>
                                            <th>Subtitle</th>
                                            <th>Photo</th>
                                            <th>View</th>
                                            <th>Meta title</th>
                                            <th>Meta Description / Keywords</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                             
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>                                     
@endsection
