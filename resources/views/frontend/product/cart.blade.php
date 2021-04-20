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
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head><!--/head-->

<body>
	@include('frontend.layouts.header')
	<div class="container">
		@if(session('success'))
	    <div class="alert alert-success alert-dismissible">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
	        {{session('success')}}
	    </div>
	@endif
	</div>
	
	@if(isset($cart))
		<section id="cart_items">
			<div class="container">

				<div class="breadcrumbs">
					<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li class="active">Shopping Cart</li>
					</ol>
				</div>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="description">ID</td>
								<td class="image">Item</td>
								<td class="description">Title</td>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>

							<?php foreach ($cart as $key => $value) { ?>
							<form method="post" enctype="multipart/form-data">
								@csrf
								<tr>
									<td class="id" id="<?php echo $value['id']; ?>"><?php echo $value['id']; ?></td>
									<td class="cart_product">
										<a><img style="width: 100px ; height: 100px" src="/upload/user/product_img/<?php echo $value['image'] ?>" alt=""></a>
									</td>
									<td class="cart_description">
										<h4><a>{{$value['name']}}</a></h4>
										<p>Web ID: {{$value['id']}}</p>
									</td>
									<td class="cart_price">
										<?php echo $value['price'] ?>
									</td>
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<a  class="cart_quantity_up" > + </a>
											<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $value['quantity'] ?>" autocomplete="off" size="2">
											<a  class="cart_quantity_down" > - </a>
										</div>
									</td>
									<td class="cart_total">
										<p class="cart_total_price"><?php echo $value['price']*$value['quantity'] ?></p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
									</td>
								</tr>
							</form>
							<?php }?>
							
						</tbody>
					</table>
				</div>
			</div>
		</section> <!--/#cart_items-->

	@else
		<section id="cart_items">
			<div class="container">
				<div class="breadcrumbs">
					<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li class="active">Shopping Cart</li>
					</ol>
				</div>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="description">ID</td>
								<td class="image">Item</td>
								<td class="description">Title</td>
								<td class="price">Price</td>
								<td class="quantity">Quantity</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							
							<tr>
								<td>ban chua them mat hang nao vao gio</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</section> <!--/#cart_items-->
	@endif
	
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li >Total <span class="total">
							@if(isset($cart))
								<?php 
									$tong = 0;
									foreach ($cart as $key => $value) { 
									$price = $value['price']*$value['quantity'];
									$tong += $price;
									}
									echo $tong;
								?>
							@else
							@endif	
								

							</span></li>

							@if(Auth::check())
								@if(isset($cart))
									<a class="btn btn-default check_out" href="{{ url('/sendmail')}}">Check Out</a>
									@else
									<h3>Ban chua co san pham nao de thanh toan</h3>
									<a href="{{ url('/index')}}">Them san pham tai day</a>
								@endif
							@else
								<h3> Vui long dang nhap de thanh toan </h3>
								<a href="{{ url('/log')}}">Login</a>
							@endif
						</ul>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
				

	
	
	@include('frontend.layouts.footer')

	

  
        <script type="text/javascript">
    	$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

        $("a.cart_quantity_up").click(function(){          
          var id = $(this).closest('tr').find('.id').attr("id");
          console.log(id);
          
          $(this).closest('tr').find('.cart_quantity_input').attr("value",parseInt($(this).closest('tr').find('.cart_quantity_input').attr("value"))+1);

          var value = $(this).closest('tr').find('.cart_quantity_input').attr("value");

          var total = parseInt($(this).closest('tr').find('.cart_price').text()) * value;
          //total
          $(this).closest('tr').find('.cart_total_price').text(total);
          $("span.total").text(parseInt($("span.total").text())+ parseInt($(this).closest('tr').find('.cart_price').text()));

          $.ajax({
            method: "POST",// phương thức dữ liệu được truyền đi
            url: "/cart",// gọi đến file server show_data.php để xử lý
            // data: $("#fr_form").serialize(),//lấy toàn thông tin các fields trong form bằng hàm serialize của jqueryinput
            data: {
                id: id,
                up:true,
                value:value,
            },
            success : function(response){//kết quả trả về từ server nếu gửi thành công
              console.log(response);
            }
          });
        });
        $("a.cart_quantity_down").click(function(){          
          var id = $(this).closest('tr').find('.id').attr("id");
          console.log(id);
          $(this).closest('tr').find('.cart_quantity_input').attr("value",parseInt($(this).closest('tr').find('.cart_quantity_input').attr("value"))-1);
          var value = $(this).closest('tr').find('.cart_quantity_input').attr("value");

          var total = parseInt($(this).closest('tr').find('.cart_price').text()) * value;
          $(this).closest('tr').find('.cart_total_price').text(total);
          //total
          $("span.total").text(parseInt($("span.total").text()) - parseInt($(this).closest('tr').find('.cart_price').text()));

          $.ajax({
            method: "POST",// phương thức dữ liệu được truyền đi
            url: "/cart",// gọi đến file server show_data.php để xử lý
            // data: $("#fr_form").serialize(),//lấy toàn thông tin các fields trong form bằng hàm serialize của jqueryinput
            data: {
                id: id,
                down:true,
                value:value,
            },
            success : function(response){//kết quả trả về từ server nếu gửi thành công
              console.log(response);
            }
          });
        });
        $("a.cart_quantity_delete").click(function(){          
          var id = $(this).closest('tr').find('.id').attr("id");
          console.log(id);
          $(this).closest('tr').remove();
          //total
          var value = $(this).closest('tr').find('.cart_quantity_input').attr("value");
          $("span.total").text(parseInt($("span.total").text()) - parseInt($(this).closest('tr').find('.cart_price').text())* value);

          $.ajax({
            method: "POST",// phương thức dữ liệu được truyền đi
            url: "/cart",// gọi đến file server show_data.php để xử lý
            // data: $("#fr_form").serialize(),//lấy toàn thông tin các fields trong form bằng hàm serialize của jqueryinput
            data: {
                id: id,
                delete:true,
            },
            success : function(response){//kết quả trả về từ server nếu gửi thành công
              console.log(response);
            }
          });
        });

        
        // total += parseInt($(".cart_total_price").text());
        // console.log(total)
        // // $("li.total").text("Total = "+ );
    </script>

</body>
</html>