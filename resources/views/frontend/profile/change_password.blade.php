@extends('frontend.main_master')

@section('content')

<!-- Showing Profile Image -->
{{-- @php
    $user = DB::table('users') -> where('id', Auth::user() -> id) -> first();
@endphp --}}

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"> <br>
                <img id="showImage" class="card-img-top" style="border-radius: 50%" src="{{ (!empty($user -> profile_photo_path)) ? url('upload/user_images/'.$user -> profile_photo_path) : url('upload/no_image.jpg') }}" width="100%" height="100%"> <br><br>

                <ul class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </ul>
            </div>

            <div class="col-md-2">

            </div>

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ Auth::user() -> name }}</strong> Update Your Password</h3>

                    <div class="card-body">

                        <form method="post" action="{{ route('user.password.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Current Password <span class="text-danger">*</span></label>
                                <input type="password" name="oldpassword" id="current_password" class="form-control">
    
                                @error('oldpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">New Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control">
    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--Image Preview before Upload-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection