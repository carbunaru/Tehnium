@extends('front.template')


@section('content')
    
<div class="page-title wb">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <h2><i class="fa fa-phone"></i> Contact</h2>
            </div><!-- end col -->
            <div class="col-lg-9 col-md-9 col-sm-12 hidden-xs-down hidden-sm-down">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </div><!-- end col -->                    
        </div><!-- end row -->
    </div><!-- end container -->
</div><!-- end page-title -->

<section class="section wb">
    <div class="container">

        <div class="row">
            

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="page-wrapper">

                    
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4>Who we are</h4>
                                                <p>{!! $contact_art->excerpt !!}</p>
                                            </div>
            
                                            <div class="col-lg-6">
                                                <h4>How we help?</h4>
                                                <p>{!! $contact_art->presentation !!}</p>
                                            </div>

                                            <div class="col-lg-6">
                                                <h4>Contact</h4>
                                                <p>Address: {!! $contact_user->address !!}<br>
                                                   Phone: {!! $contact_user->phone !!}<br>
                                                   Email: {!! $contact_user->email !!}</p>
                                            </div>
            
                                            <div class="col-lg-12">
                                                <blockquote class="blockquote">Please read <a href="#">Licensing & Terms</a> of Use if you are wondering about the license. </strong></blockquote>
                                            </div>
                                        </div><!-- end row -->
            
            
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form class="form-wrapper">
                                                <h4>Contact form</h4>
                                                    <input type="text" class="form-control" placeholder="Your name">
                                                    <input type="text" class="form-control" placeholder="Email address">
                                                    <input type="text" class="form-control" placeholder="Phone">
                                                    <input type="text" class="form-control" placeholder="Subject">
                                                    <textarea class="form-control" placeholder="Your message"></textarea>
                                                    <button type="submit" class="btn btn-primary">Send <i class="fa fa-envelope-open-o"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                      



                </div><!-- end page-wrapper -->

                

                
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</section>

@endsection