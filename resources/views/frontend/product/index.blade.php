@extends('frontend.layouts.app') @section('content') <!-- blog --> 
<div class="col-sm-9 padding-right">
	@if(session('success'))
	<div class="alert alert-success alert-dismissible"> 
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> 
		<h4><i class="icon fa fa-check"></i> Thông báo!</h4> {{session('success')}} </div> @endif 
	</div> 
	<div class="col-sm-9 padding-right"> <div class="features_items"><!--features_items--> <h2 class="title text-center">Features Items</h2> 
		<form action="{{URL::to('/search_ad')}}" method="POST"> 
			@csrf <input class="col-sm-3 padding-right" name="key" type="text" placeholder="Search"/> 
			<select class="col-sm-2 padding-right" name="price" class="form-control form-control-line"> 
				<option value="null"> price</option> 
				<option value="1-100"> 1->100 </option> 
				<option value="100-500"> 100->500 </option> 
				<option value="500-1000"> 100->1000 </option> 
				<option value="1000-max"> 1000->max </option> 
			</select> 
			<select class="col-sm-2 padding-right" name="category" class="form-control form-control-line"> 
				<option value="null">Category</option> 
				@foreach($getCategory as $key => $value) 
					<option 
						<?php echo "selected"?>value="{{ $value['id'] }}"> {{ $value['name'] }}
					 </option> 
				@endforeach </select> 
			<select class="col-sm-2 padding-right" name="brand" class="form-control form-control-line"> 
				<option value="null">Brand</option> 
				@foreach($getBrand as $key => $value) 
					<option 
						<?php echo "selected"?>value="{{ $value['id'] }}"> {{ $value['name'] }} 
					</option> 
				@endforeach </select> 
			<button type="submit" class="btn btn-success"> submit</button> 
		</form> 
		@foreach ($newProducts as $product) 
		@foreach($product as $value) 
		<div class="product-view col-sm-4 "> 
			<div class="product-image-wrapper"> 
				<div class="single-products" style="padding-right: 10px"> 
				<div class="productinfo text-center"> 
					<?php $image = json_decode($value->image); ?> 
				<img width="100" height="70" src="/upload/user/product_img/<?php echo $image[0] ?>"> 
				@if($value->sale != 0) 
				<?php $sale_price = $value->price *((100-$value->sale)/100); ?> 
				<h2>{{$sale_price}}</h2> 
				@else 
				<h2>{{$value->price}}</h2>
				@endif 
				<p>{{$value['name']}}</p> 
				<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart">

				</i>Add to cart</a> 
			</div> 
			<div class="product-overlay"> 
				<div class="overlay-content"> 
					<a href="{{ url('product/detail/'.$value->id) }}">
					@if($value->sale != 0) 
					<?php $sale_price = $value->price *((100-$value->sale)/100); ?>
					<h2>{{$sale_price}}</h2> 
					@else <h2>{{$value->price}}</h2> 
					@endif 
					<p>{{$value['name']}}</p>
				</a> 
				<a id="<?php echo $value['id']?>" class="btn btn2 btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a> 

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
		@endforeach 
</div><!--features_items--> 
</div> 
<script type="text/javascript">
	$(document).ready(function(){
		$.ajaxSetup({ 
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }}); 
		$('a.btn2').click(function(){
			var id = $(this).attr("id"); var totalCart = $(".cart_value").text(); 
			$(".cart_value").text((parseInt(totalCart) + 1)); 
			var checkLogin = "{{Auth::check()}}"; 
			if (checkLogin == 1) { 
				$.ajax({
				 type:'POST', 
				 url:"add-Cart", 
				 data:{ id: id, }, 
				 success:function(data){ 
				 } 
				}); 
			}else{ alert("Login to add "); 
			} 
		}); 


		$('.slider-track').click(function(){
			var priceRage = $(".tooltip-inner").text();
			var arr = [];
			arr = priceRage.split(':');

			var checkLogin = "{{Auth::check()}}"; 
			if (checkLogin == 1) { 
				$.ajax({
				 type:'POST', 
				 url:"price_rage", 
				 data:{ priceRage : arr}, 
				 success:function(response){ 
				 	if(response.product){
				 		var html = "";
				 		var newArr = response.product;

				 		newArr.map(function(product){
				 			var image = jQuery.parseJSON(product['image']);
						if(product['sale'] != 0){
								 sale_price = product['price'] *((100-product['sale'])/100);
						}else {
							sale_price = product['price'];
						}	
				 			html += '<div class="product-view col-sm-4 ">'+
				 					'<div class="product-image-wrapper"> '+
				 					'<div class="single-products"style="padding-right:10px">' +
				 					'<div class="productinfo text-center">'+
				 						'<img width="100" height="70" src="/upload/user/product_img/'+image[0]+'">'+
				 							'<h2>'+ sale_price +'</h2>'+
				 							'<p>'+product['name']+'</p> '+
				 							'<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart">'+
				 					'</div>'+
				 					



				 					'</div>'+
				 					'</div>'+
						 			'</div>';


				 		})
				 		$('.features_items').html(html);
				 		
				 	}
				 } 
				}); 
			}else
				{ 
					alert("Login to add "); 
				} 
		}); 




	}); 
</script> 
@endsection