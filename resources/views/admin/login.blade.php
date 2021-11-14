@extends('admin.template-forms')

@section('title','Login')

        @section('content')
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input name="email" class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                                @error('email') <span class="text-danger sm">{{$message}}</span> @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                                @error('password') <span class="text-danger sm">{{$message}}</span> @enderror
                                            </div>
                                            <div class="form-check mb-3">
                                                <input name="remember" class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <button type="submit" class="btn btn-primary btn-block" href="index.html">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="{{route('register')}}">Need an account? Sign up!</a></div>
                                        <a class="small" href="{{route('password.request')}}">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
        @endsection        