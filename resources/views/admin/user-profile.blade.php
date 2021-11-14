@extends('admin.template')
@section('title', $user->name)

@section('content')

<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Control Panel</a></li>
  <li class="breadcrumb-item active">Profile</li>
</ol>
<div class="row">
  <div class="col-md-8">
    <div class="card p-3">
        <form action="{{route('user-updateProfile')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-row">
              <div class="form-group col-md-6">
                    <div id="img-preview">
                      <img class="photo-preview" src="/admin/images/users/{{$user->photo}}" alt="" style="display:inline-block;max-width:200px;">
                    </div>
                    <div class="custom-file" style="width:200px;margin:20px 0;">
                      <input type="file" class="custom-file-input  @error('photo') is-invalid @enderror" id="choose-file" accept="image/*" name="photo">
                      <label class="custom-file-label" for="choose-file">Choose file</label>
                      @error('photo') <span class="text-danger small">{{$message}}</span> @enderror 
                    </div>
              </div>

              <div class="form-group col-md-6">
                <p>Created at: {{$user->created_at->format('D j F Y h:i') }}</p>
                <p>Updated at: {{$user->updated_at->format('D j F Y h:i') }}</p>
                <p>Role: <strong>{{ucwords($user->role) }}</strong></p>
                <p>{!! $user->hasVerifiedEmail() ?  '<i class="fas fa-check text-success" style="cursor:pointer;"></i> Verified email' : '<i class="fas fa-minus-circle text-danger"  style="cursor:pointer;"></i> Unverified email' !!}</p>
              </div>
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
          
          <br>
          <button type="submit" class="btn btn-primary float-right">Update profile</button>
          <a href="{{route('dashboard')}}" type="submit" class="btn btn-secondary float-right mr-2">Cancel</a>

        </form>
    </div>    
  </div>

  <div class="col-md-4">
    <div class="card p-3">
        <h3>Reset Password</h3>
        <form action="{{route('user-resetPassword')}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')

          <div class="form-group">
          <label for="inputOldPassword">Password</label>
          <input type="password" class="form-control @error('password_old') is-invalid @enderror" id="inputOldPassword" placeholder="Add a password..."  name="password_old">
          @error('password_old') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
          <div class="form-group">
          <label for="inputNewPassword">New password</label>
          <input type="password" class="form-control @error('password_new') is-invalid @enderror" id="inputNewPassword" placeholder="Add a password..."  name="password_new">
          @error('password_new') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
          <div class="form-group">
            <label for="confirmNewPassword">Confirm new password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" placeholder="Confirm password..." name="password_confirmation">
            @error('password_confirmation') <span class="text-danger small">{{$message}}</span> @enderror 
          </div>
          <button type="submit" class="btn btn-danger float-right ">Reset password</button>
        </form> 
    </div> 
  </div> 
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