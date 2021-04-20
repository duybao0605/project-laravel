
@extends('frontend.layouts.app')
@section('content')

	
	<div class="product-details"><!--product-details-->
			<div class="col-sm-5">
				<div class="view-product">
					<?php $image = json_decode($product->image);
											?>
											
					<img width="100" height="70" src="/upload/user/product_img/<?php echo $image[0] ?>">
					
					<a href="/upload/user/product_img/<?php echo $image[1] ?>" rel="prettyPhoto"><h3>ZOOM</h3></a>
					
				</div>
				<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
				<div class="item active">
					@if(count($image) == 3)
					  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0] ?>" alt=""></a>
					  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[1] ?>" alt=""></a>
					  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[2]?>" alt=""></a>
					@endif
					@if(count($image) < 3 && count($image) != 3)
					  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0] ?>" alt=""></a>
					  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[1] ?>" alt=""></a>
					  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0]?>" alt=""></a>
					@endif
					@if(count($image) < 2)
					  	<a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0] ?>" alt=""></a>
					  	<a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0] ?>" alt=""></a>
					  	<a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0]?>" alt=""></a>
					@endif

				</div>

				@for($i = 0;$i < 2 ;$i++)
					@if(count($image) == 3)
						<div class="item">
			  				<a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0] ?>" alt=""></a>
					  		<a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[1] ?>" alt=""></a>
					  		<a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[2]?>" alt=""></a>
						</div>
						<?php $i+=1 ?>
					@endif
					@if(count($image) < 3 && count($image) != 3)
						<div class="item">
						  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0] ?>" alt=""></a>
				  		  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[1] ?>" alt=""></a>
					      <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0]?>" alt=""></a>
					      <?php $i+=1 ?>
						</div>
						@elseif(count($image) < 2)
						<div class="item">
						  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0] ?>" alt=""></a>
					  	  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0] ?>" alt=""></a>
					  	  <a><img width="84px" height="85px" src="/upload/user/product_img/<?php echo $image[0]?>" alt=""></a>
					  	  <?php $i+=1 ?>

						</div>
					@endif

				@endfor
				
				
			</div>


								  <!-- Controls -->
			  <a class="left item-control" href="#similar-product" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			  </a>
			  <a class="right item-control" href="#similar-product" data-slide="next">
				<i class="fa fa-angle-right"></i>
			  </a>
		</div>

	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<img src="images/product-details/new.jpg" class="newarrival" alt="" />
			<h2>{{$product->name}}</h2>
			<p>Web ID: {{$product->id}}</p>
			<img src="images/product-details/rating.png" alt="" />
			<span>
				<span>US ${{$product->price}}</span>
				<label>Quantity:</label>
				<input type="text" value="3" />
				<button type="button" class="btn btn-fefault cart">
					<i class="fa fa-shopping-cart"></i>
					Add to cart
				</button>
			</span>
			<p><b>Availability:</b> In Stock</p>
			<p><b>Condition:</b> New</p>
			<p><b>Brand:</b> {{$product->brand}}</p>
			<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->	
<script type="text/javascript">
    	$(document).ready(function(){
		    $("a[rel^='prettyPhoto']").prettyPhoto();
		});
</script>
@endsection








