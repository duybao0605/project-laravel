<!DOCTYPE html>
<html lang="en">
<head>
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">

    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    
    <link rel="apple-touch-icon-precomposed" href="{{asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
    <script src="{{asset('frontend/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
</head><!--/head-->

<body>
	@include('frontend.layouts.header')

	
	<section id="form"><!--form-->
		<div class="container">
		
	    	<div class="row">
	    		<div class="col-sm-6">
	    			<h2 class="title text-center">ACCOUNT</h2>
	    			<h4><a href="{{ url('/account/'.Auth::user()->id) }}">ACCOUNT</a></h4>
	    			<h4><a href="/product/list">MY PRODUCT</a></h4>
	    		</div>
				<div style="float: right" class="col-sm-5">
					@if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            {{session('success')}}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

					<div class="signup-form"><!--sign up form-->
						<h2>Add product</h2>
						<form method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
                                <div class="col-sm-12">
									name<input type="text" name="name" value="{{$data->name}}" />
								</div>
							</div>
							<div class="form-group">
                                <div class="col-sm-12">
									price<input type="number" name="price" value="{{$data->price}}"  />
								</div>
							</div>
							@if($data->sale != 0)
							<div class="form-group">
                                <div class="col-sm-12">
                                	<?php $sale_price = $data->price *((100-$data->sale)/100); ?>
									salePrice<input type="number" name="price" value="{{$sale_price}}"  />
								</div>
							</div>
							@else
							@endif
							
							<div class="form-group">
                                <div class="col-sm-12">
                                    category<select name="category" class="form-control form-control-line">
                                        <option value="{{$data->category}}">{{$data->category}}</option>


                                        @foreach($getCategory as $key => $value)
                                        <option
                                            <?php echo "selected"?>value="{{ $value['id'] }}">
                                            {{ $value['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    brand<select name="brand" class="form-control form-control-line">
                                        <option value="{{$data->brand}}">{{$data->brand}}</option>


                                        @foreach($getBrand as $key => $value)
                                        <option
                                            <?php echo "selected"?>value="{{ $value['id'] }}">
                                            {{ $value['name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">

                                    status<select name="status" class="selected form-control form-control-line">
                                    	@if($data->status == 0)
                                        <option value="{{$data->status}}">
                                        	{{"new"}}
                                        </option>
                                        <option value="1">
                                            sale
                                        </option>
                                        @else
                                        <option value="{{$data->status}}">
                                        	{{"sale : "}}{{$data->sale ."%"}}
                                        </option>
                                        <option value="0">
                                            new
                                        </option>
                                        @endif
                                    </select>


                                </div>
                             </div>
                           
                            <div class="form-group">

                                <div class="col-sm-6" id="sale" style="display: none;" > 
	                                <input  type="text" name="sale" placeholder="nhap sale">
	                            </div>
                            </div>
                            <p></p>
                            <div class="form-group">
                                <div class="col-sm-12">
		                            Company<input type="text" name="company" placeholder="company">
		                        </div>
		                    </div>
		                    <div class="form-group">
                                <div class="col-sm-12">
		                            Image<input type="file" name="image[]" multiple>
		                        </div>
		                    </div>

                            <div class="form-group">
                            	<div class="col-sm-12">
	                            	Detail<textarea name="detail" placeholder="Detail"></textarea>
	                            </div>
                            </div>

                            <div class="form-group">
                            	<div class="col-sm-12">
									<button type="submit" class="btn btn-success">Add product</button>
								</div>
							</div>
							
						</form>
					</div><!--/sign up form-->
				</div>

				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Online Help</a></li>
								<li><a href="">Contact Us</a></li>
								<li><a href="">Order Status</a></li>
								<li><a href="">Change Location</a></li>
								<li><a href="">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">T-Shirt</a></li>
								<li><a href="">Mens</a></li>
								<li><a href="">Womens</a></li>
								<li><a href="">Gift Cards</a></li>
								<li><a href="">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Privecy Policy</a></li>
								<li><a href="">Refund Policy</a></li>
								<li><a href="">Billing System</a></li>
								<li><a href="">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Company Information</a></li>
								<li><a href="">Careers</a></li>
								<li><a href="">Store Location</a></li>
								<li><a href="">Affillate Program</a></li>
								<li><a href="">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	<script type="text/javascript">
		$(document).ready(function(){
			var status = $("select.selected").val();
			if(status == 1){
		    		$("#sale").show();
		    	} else {
		    		$("#sale").hide();
		    
		    	}

		    $("select.selected").change(function(){
		    	var status = $(this).val();
		    	
		    	if(status == 1){
		    		$("#sale").show();
		    	} else {
		    		$("#sale").hide();
		    
		    	}
		    });	
		});
	</script>

  
    
</body>
</html>



