@extends('admin.template')
@section('title', 'Manage Users')
@section('content')

                    
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Users ({{$users->count()}})
                                <a href="{{route('user-new')}}" class="btn btn-success float-right">New User</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th><i class="far fa-envelope"></i></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Photo</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{!! $user->hasVerifiedEmail() ?  '<i class="fas fa-check text-success" title="Verified email" style="cursor:pointer;"></i>' : '<i class="fas fa-minus-circle text-danger"  style="cursor:pointer;" title="Unverified email"></i>' !!}</td>
                                            <td>{{$user->name}}<br>
                                            {{$user->created_at->format('D j F Y h:i') }}
                                        </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->address}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td><img class="user-avatar" src="/admin/images/users/{{$user->photo}}"></td>
                                            <td>
                                                @if($user->role=='author')
                                                    <a class="text-hover" style="color:#000;" href="{{ route('admin.showArticles', ['author'=>$user->id]) }}">{{$user->role}}</a>&nbsp;&nbsp;<span class="badge badge-success">  {{ $user->articles->count() }}</span>
                                                @else
                                                    {{$user->role}}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('user-editForm', $user->id)}}" class="btn btn-success btn-circle btn-md" title="Edit user"><i class="fas fa-2x fa-user-edit m-1"></i></a>
                                                
                                                <form id="form-delete-{{$user->id}}" action="{{route('user-delete',$user->id)}}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('delete')
                                                </form>

                                                <button type="button" class="btn btn-danger btn-circle btn-md confirm" title="Delete user"
                                                
                                                    onclick="if(confirm('Are you sure you want to delete this user: {{$user->name}}?')){
                                                        document.getElementById('form-delete-{{$user->id}}').submit();
                                                    }"
                                                
                                                ><i class="fas fa-2x fa-trash"></i></button>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><i class="far fa-envelope"></i></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Photo</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                             
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>                                     
@endsection
