@extends('frontend.main_master')

@section('islamic')
@include('frontend.body.mobile_sidbar_menu')

<section class="profile main-content">
    <div class="container">
        <br>
     <br>
      
        <div class="row profile-wrapper">
            <div class="col-lg-3">
                 @include('frontend.common.user_sidebar')
            </div>
            <div class="col-lg-9">

            </div>
        </div>
    </div>

</section>

@endsection
