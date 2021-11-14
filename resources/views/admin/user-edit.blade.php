@extends('admin.template')
@section('title', $user->name)

@section('content')

<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
  <li class="breadcrumb-item"><a href="{{route('users')}}">Users</a></li>
  <li class="breadcrumb-item active">Edit User</li>
</ol>

<div class="card p-3">
    <form action="{{route('user-update', $user->id)}}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('put')

      <div class="form-row">
        <div class="form-group col-md-2">
          <div id="img-preview">
            <img class="photo-preview" src="/admin/images/users/{{$user->photo}}" alt="" style="display:inline-block;max-width:200px;">
          </div>         
        </div>
        <div class="form-group col-md-10">
                <p>Created at: {{$user->created_at->format('D j F Y h:i') }}</p>
                <p>Updated at: {{$user->updated_at->format('D j F Y h:i') }}</p>
                <p>Role: <strong>{{ucwords($user->role) }}</strong></p>
                <p>{!! $user->hasVerifiedEmail() ?  '<i class="fas fa-check text-success" style="cursor:pointer;"></i> Verified email' : '<i class="fas fa-minus-circle text-danger"  style="cursor:pointer;"></i> Unverified email' !!}</p>
        </div>  
      </div>
      
      <div class="custom-file" style="width:200px;margin:20px 0;">
        <input type="file" class="custom-file-input  @error('photo') is-invalid @enderror" id="choose-file" accept="image/*" name="photo">
        <label class="custom-file-label" for="choose-file">Choose file</label>
        @error('photo') <span class="text-danger small">{{$message}}</span> @enderror 
      </div>
      
      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name" name="name" value="{{$user->name}}">
            @error('name') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email"  name="email" value="{{$user->email}}">
            @error('email') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
      </div>
      
      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" placeholder="Add your address..." name="address" value="{{$user->address}}">
            @error('address') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
          <div class="form-group col-md-6">
            <label for="inputPhone">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" placeholder="Add a phone number..." name="phone" value="{{$user->phone}}">
            @error('phone') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputRole">Role</label>
          <select class="custom-select @error('role') is-invalid @enderror" id="inputRole" name="role">
            
            <option value="admin" {{$user->role == "admin" ? 'selected' : ''}}>Admin</option>
            <option value="author" {{$user->role == "author" ? 'selected' : ''}}>Author</option>
            <option value="edithor" {{$user->role =="edithor" ? 'selected' : ''}}>Edithor</option>
          </select>
          @error('role') <span class="text-danger small">{{$message}}</span> @enderror 
        </div>
        <div class="form-group col-md-6">
          <label for="inputCheck">Check email</label>
          <select class="custom-select" id="inputCheck" name="checkEmail">
            <option value="false" selected>No action</option>
            @if (!$user->email_verified_at)
            <option value="send">Sent notification</option>
            <option value="validate">Validate email</option>
            @else
            <option value="invalidate">Invalidate email</option>
            @endif
          </select>
        </div>
      </div>  
      
      <br>
      <button type="submit" class="btn btn-primary float-right">Update user</button>
      <a href="{{route('users')}}" type="submit" class="btn btn-secondary float-right mr-2">Cancel</a>

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
@endsection