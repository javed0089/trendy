 @extends('layouts.main')

 @section('title','Result')


 @section('content')

  <!-- Main Content Section -->
        <main class="main">
           

            <div class="container">
              
                <section class="contact-form">
                    <div class="row form">
                    <div class="spacer-80"></div>
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3 text-center">
                                  @if(session('error'))
                                        <div class="alert alert-danger">
                                  
                                          {{session('error')}}
                                       
                                        </div>
                                      @endif
                                       @if(session('success'))
                                        <div class="alert alert-success">
                                  
                                          {{session('success')}}
                                       
                                        </div>
                                      @endif
                                   <a href="/" class="btn btn-success btn-md">Return Home</a>
                                </div>
                        </div>
                     
                    </div>

                </section>
            </div>
        </main>
        <!-- Main Content Section -->
    

@endsection


@section('scripts')
 

@endsection
