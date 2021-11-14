@extends('admin.template')
@section('title', 'Create New User')

@section('content')

<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
  <li class="breadcrumb-item"><a href="{{route('users')}}">Users</a></li>
  <li class="breadcrumb-item active">Create new user</li>
</ol>

<div class="card p-3">
    <form action="{{route('user-add')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div id="img-preview">
        <img class="photo-preview" src="/admin/images/users/default.jpg" alt="" style="display:inline-block;max-width:200px;">
      </div>

      <div class="form-row">
        <div class="custom-file col-md-2 my-3">
          <input type="file" class="custom-file-input  @error('photo') is-invalid @enderror" id="choose-file" accept="image/*" name="photo">
          <label class="custom-file-label" for="choose-file">Choose file</label>
          @error('photo') <span class="text-danger small">{{$message}}</span> @enderror 
        </div>
        <div class="form-group m-4 text-info">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="gridCheck" value="1" name="verified">
            <label class="form-check-label" for="gridCheck">
              Email verified
            </label>
          </div>
        </div>
      </div>
      
      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputName">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name" name="name" value="{{old('name')}}">
            @error('name') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
          <div class="form-group col-md-6">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email"  name="email" value="{{old('email')}}">
            @error('email') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
      </div>
      
          <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" placeholder="Add your address..." name="address" value="{{old('address')}}">
            @error('address') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputPhone">Phone</label>
          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" placeholder="Add a phone number..." name="phone" value="{{old('phone')}}">
          @error('phone') <span class="text-danger small">{{$message}}</span> @enderror 
        </div>
      
        <div class="form-group col-md-6">
          <label for="inputRole">Role</label>
          <select class="custom-select @error('role') is-invalid @enderror" id="inputRole" name="role" value="{{old('role')}}">
            
            <option value="admin">Admin</option>
            <option value="author" selected>Author</option>
            <option value="edithor">Edithor</option>
          </select>
          @error('role') <span class="text-danger small">{{$message}}</span> @enderror 
        </div>
      </div>  
      <div class="form-row">
        <div class="form-group col-md-6">
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" placeholder="Add a password..."  name="password">
        @error('password') <span class="text-danger small">{{$message}}</span> @enderror 
        </div>
        <div class="form-group col-md-6">
          <label for="confirmPassword">Confirm password</label>
          <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" placeholder="Confirm password..." name="password_confirmation">
          @error('password_confirmation') <span class="text-danger small">{{$message}}</span> @enderror 
        </div>
      </div>


      <br>
      <button type="submit" class="btn btn-primary float-right">Add user</button>
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