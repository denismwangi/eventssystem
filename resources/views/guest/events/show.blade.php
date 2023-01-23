<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>Event System</title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="{{url('static/css/bootstrap.min.css')}}"/>

        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="{{url('static/css/slick.css')}}"/>
        <link type="text/css" rel="stylesheet" href="{{url('static/css/slick-theme.css')}}"/>

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="{{url('static/css/nouislider.min.css')}}"/>

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="{{url('static/css/font-awesome.min.css')}}">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="{{url('static/css/style.css')}}"/>

        

    </head>
    <body>
        <!-- HEADER -->
      
        <nav id="navigation">
            <!-- container -->
            <div class="container">
                <!-- responsive-nav -->
                <div id="responsive-nav">
                    <!-- NAV -->
                   <ul class="main-nav nav navbar-nav">
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="/login">Login</a></li>
                        <!-- <li><a href="#">Categories</a></li>
                        <li><a href="#">Laptops</a></li>
                        <li><a href="#">Smartphones</a></li>
                        <li><a href="#">Cameras</a></li>
                        <li><a href="#">Accessories</a></li> -->
                    </ul>
                    <!-- /NAV -->
                </div>
                <!-- /responsive-nav -->
            </div>
            <!-- /container -->
        </nav>
    <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">


                @if (Session::has('success'))

                    <div class="alert alert-success" role="alert" style="max-width: 500px;">
               {{ session('success') }}
              </div>

               @endif
               @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
               {{ session('error') }}
              </div>

               @endif

                   <form method="POST" action="{{url('/event/book')}}">
                      {{ csrf_field() }}
                    @php
                     $amount = App\Ticket::where('id', $event->ticket_id)->first();
                     $amount_a = $amount->price;

                    @endphp

                    <div class="col-md-5">
                         <div class="form-row">
                            <input type="hidden" name="ticket_id" value="{{$event->ticket_id}}" class="form-control" id="inputEmail4">
                            <input type="hidden" name="event_id" value="{{$event->id}}" class="form-control" id="inputEmail4">
                            <div class="form-group">
                              <label for="inputEmail4">Name</label>
                              <input type="text" name="name" class="form-control" id="inputEmail4">
                               @if($errors->has('name'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                            </div>
                            <div class="form-group">
                              <label for="inputEmail4">Email</label>
                              <input type="email" name="email" class="form-control" id="inputEmail4">
                               @if($errors->has('email'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                            </div>
                            <div class="form-group">
                              <label for="inputPassword4">Phone</label>
                              <input type="text" name="phone" class="form-control" id="inputPassword4">
                               @if($errors->has('phone'))
                        <p class="help-block" style="color: red;">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputAddress">Amount</label>
                            <input type="text" class="form-control" id="inputAddress" readonly="" name="amount" placeholder="" value="{{$amount_a}}">
                          </div>
                          
                           
  
                    </div>
                   @php
                   $price = App\Ticket::where('id', $event->ticket_id)->first();
                   $pr= $price->price;

                   @endphp
                    <div class="col-md-5">
                        <div class="product-details">
                            <h2 class="product-name">{{ $event->title }}</h2>
                            <div>
                                 @if( !empty($event->image))
                                  <img class="card-img-top" style="width:100%; height: 180px;" src="{{ URL::asset('static/images/events/'.$event->image )}}" alt="event image">
                                   @else
                                    <img class="card-img-top" style="width:100%; height: 180px;" src="{{ URL::asset('static/images/events/default.jpg')}}" alt="event image">
                                   @endif
                               <p><span class="label label-default">{{ $event->venue }}</span></p>
                                        <p> <span class="label label-info"> {{ $event->start_time }}</span></p>
                            </div>
                            <div>
                                <h3 class="product-price">KES {{$pr}}
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                           

                            <div class="add-to-cart">
                                
                                <button type="submit" class="add-to-cart-btn"><i class=""></i>Book Ticket</button>
                            </div>

                            

                        </div>
                    </div>
                 
                    </form>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>