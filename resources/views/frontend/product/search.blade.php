@extends('frontend.layouts.app')
@section('content')
<?php
	
 ?>
 	<!-- blog -->
 	<div class="col-sm-9 padding-right">
 	@if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            {{session('success')}}
        </div>
    @endif
    </div>
    <div class="col-sm-9 padding-right">
		<div class="features_items"><!--features_items-->

			<h2 class="title text-center">Ket qua tim kiem</h2>
					
                    
			@foreach ($searchProduct as $value)
			<div class="col-sm-4 ">

				<div class="product-image-wrapper">
					<div class="single-products" style="padding-right: 10px">
							<div class="productinfo text-center">

								<?php $image = json_decode($value->image);
											?>
								<img width="100" height="70" src="/upload/user/product_img/<?php echo $image[0] ?>">
								@if($value->sale != 0)
									<?php $sale_price = $value->price *((100-$value->sale)/100); ?>
									<h2>{{$sale_price}}</h2>
								@else
									<h2>{{$value->price}}</h2>

								@endif
								
								<p>{{$value['name']}}</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>
							
							<div class="product-overlay">
								<div class="overlay-content">
									<a href="{{ url('product/detail/'.$value->id) }}">
									@if($value->sale != 0)
									<?php $sale_price = $value->price *((100-$value->sale)/100); ?>
									<h2>{{$sale_price}}</h2>
									@else
										<h2>{{$value->price}}</h2>

									@endif
									<p>{{$value['name']}}</p>
									</a>
									<a href="{{ url('/add-Cart/'.$value->id) }}" id="<?php echo $value['id']?>" class="btn btn2 btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>

							</div>

					</div>

					<div class="choose">
						<ul class="nav nav-pills nav-justified">
							<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
							<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
						</ul>
					</div>
				</div>
			</div>
			@endforeach
					
		</div><!--features_items-->
	</div>
	
	<script type="text/javascript">
    	
    	$(document).ready(function(){
    		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
    		});
	    	$('a.btn2').click(function(){
	    		var id = $(this).attr("id");
	
		        var checkLogin = "{{Auth::check()}}";
		        if (checkLogin == 1) {
		        	$.ajax({
			           type:'GET',
			           url:"add-Cart/"+id,
			           data:{
			           	id: id,
			           },
			           	success:function(data){
			           }
			        });
		        	
		        }else{
		        	alert("Login to add ");	
		        }

	   		});
    	});

    </script>
		

@endsection



