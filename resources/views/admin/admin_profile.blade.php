@extends('admin.admin_master')

@section('admin')

<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="box box-inverse bg-img" style="background-image: url({{ asset('backend/images/gallery/full/1.jpg);') }}" data-overlay="2">

<!-- Start ======================= Profile ========================= -->
                <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
                    <li>
                        <a href="{{ route('admin.profile.edit') }}" style="float: right;" class="btn btn-rounded btn-info">Edit Profile</a>  
                    </li>
                </ul>               

                <div class="box-body text-center pb-50">
                    <img class="avatar avatar-xxl avatar-bordered" src="{{ (!empty($adminProfile -> profile_photo_path)) ? url('upload/admin_images/'.$adminProfile -> profile_photo_path) : url('upload/no_image.jpg') }}" alt="">

                    <h3 class="mt-2 mb-0"><a class="hover-primary text-white">Name: {{ $adminProfile -> name }}</a></h3>
                    <h5 class="mt-2 mb-0"><a class="hover-primary text-white">e-Mail: {{ $adminProfile -> email }}</a></h5>
                    <span><i class="fa fa-map-marker w-20"></i> Japan</span>
                </div>
<!-- End ========================= Profile ========================= -->

                <ul class="box-body flexbox flex-justified text-center" data-overlay="4">
                  <li>
                    <span class="opacity-60">Followers</span><br>
                    <span class="font-size-20">8.6K</span>
                  </li>
                  <li>
                    <span class="opacity-60">Following</span><br>
                    <span class="font-size-20">8457</span>
                  </li>
                  <li>
                    <span class="opacity-60">Tweets</span><br>
                    <span class="font-size-20">2154</span>
                  </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
    
@endsection