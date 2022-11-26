@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Admin Change Password</h4>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                            <form method="post" action="{{ route('update.change.password') }}">
                                @csrf

                                <div class="card-body">
                                    @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>

                                @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                                @endif

                                    <div class="row">
                                        <div class="col-12">						
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Current Password <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput">
                                                            @error('old_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>New Password <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput">
                                                            @error('new_password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
    
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Confirm Password <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>         
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Update">
                                </div>
                            </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->

    </section>
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