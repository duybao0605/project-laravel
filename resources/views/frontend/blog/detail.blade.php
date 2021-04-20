@extends('frontend.layouts.app')
@section('content')
 	<!-- blog -->
    @foreach ($blogs as $blog)
    
	<div class="blog-post-area">
		<h2 class="title text-center">LATEST FROM OUR BLOG</h2>
		<div class="single-blog-post">
			<h3>{{ $blog->title }}</h3>
			<!--  -->
			
			<div class="rate">
                <div class="vote">
                    <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                    <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                    <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                    <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                    <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                    @if($countRate > 0)
                    <span class="rate-np">
                    	@foreach($totalRate as $totalRate)
                    		<?php 
                    			$total = 0;
                    			$total += $totalRate->rate;
                    			
                    		 ?>
                    	@endforeach
                    	{{$total/$countRate}}
                    </span>

                    @else
                    <span class="rate-np">
                    	{{'chua co danh gia nao'}}
                    </span>
                    @endif
                </div> 
            </div>
            
            <!--  -->
            <h5>{{ $blog->description }}</h5>
			<a href="">
				<img src="/upload/user/blog-img/<?php echo $blog->image ?>" alt="">
			</a>
			<p>
				{!! $blog->content !!}
			</p>
			
		</div>
	@endforeach


		
	<!--Comments-->
	</div>
		<div class="response-area">
			<h2>{{$count}} RESPONSES</h2>
			<ul class="media-list">
				<?php foreach ($comment as $value) { ?>
					@if($value->level == 0)
				
				<li class="getId media">
					<a class="pull-left" href="#">
						<img width="85px" height="98px" class="media-object" src="/upload/user/avatar/<?php echo $value->avatar ?>" alt="">
					</a>
					<div class="media-body">
						<ul class="sinlge-post-meta">
							<li><i class="fa fa-user"></i>{{$value->name}}</li>
							<li><i class="fa fa-clock-o"></i> {{$value->created_at}}</li>
						</ul>
						<p>{{$value->content}}</p>
						<a id="<?php echo $value->id ?>" class="id btn btn-primary" href="#cmt"><i class="fa fa-reply"></i>Replay</a>
					</div>
				</li>
					@endif
					<!-- reply -->
					@if($value->id == $reply->level)
						<li class="media second-media">
							<a class="pull-left" href="#">
								<img width="85px" height="98px" class="media-object" src="/upload/user/avatar/<?php echo $reply->avatar ?>" alt="">
							</a>
							<div class="media-body">
								<ul class="sinlge-post-meta">
									<li><i class="fa fa-user"></i>{{$reply->name}}</li>
									<li><i class="fa fa-clock-o"></i> {{$reply->created_at}}</li>
								</ul>
								<p>{{$reply->content}}</p>
								<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
							</div>
						</li>

					@endif
				<?php } ?>
			
			</ul>					
		</div>

		<!-- alert -->
		@if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            {{session('success')}}
        </div>
	    @endif

	    <?php if($errors->any()){ ?>
            <?php 
                foreach ($errors->all() as $error) {
                    # code...
                    echo '<p class="text-danger">' .$error. '</p>';
                }
            ?>
        <?php } ?>

        <!-- getId -->
		@if(Auth::check())
			<div style="padding-bottom: 20px" class="col-sm-9" id="cmt">
				<form action="{{ url('comment/'.$blog->id) }}" method="POST">
					@csrf
					<div class="text-area">
						<div class="blank-arrow">
							<label><?php echo Auth::user()->name; ?></label>
						</div>
						<span>*</span>
						<textarea name="content" rows="2"></textarea>
						<input class="level" name="level" rows="2" value="">
						<button class="comment"  class="btn btn-warnning">Comment</button>
					</div>
				</form>
			</div>

		@else 
			<div style="padding:10px 0 50px 0">
				<button class="btn btn-default"><a href="/log">Login to comment</a></button>
			</div>
		@endif

		{!! $blogs->links() !!}

		</div><!--/blog-post-area-->

		<script type="text/javascript">
			$("a.id").click(function(){
				var $id = $(this).attr("id");
				console.log($id);
				$level = $("button.comment").prev().attr("value");
				console.log($("input.level").val($id));

			})	
			

		</script>
		<script type="text/javascript">
    	
    	$(document).ready(function(){
    		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
    		});
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
				var Values =  $(this).find("input").val();
		    	if ($(this).hasClass('ratings_over')) {
		            $('.ratings_stars').removeClass('ratings_over');
		            $(this).prevAll().andSelf().addClass('ratings_over');
		        } else {
		        	$(this).prevAll().andSelf().addClass('ratings_over');
		        }
		        // 1 la dang nhap != la chua
		        var checkLogin = "{{Auth::check()}}"
		        if (checkLogin == 1) {
		        	$.ajax({
			           type:'POST',
			           url:"{{ url('ajax/rate') }}",
			           data:{
			           	rate:Values,
			           	id: "{{$blog->id}}"
			           },
			           success:function(data){
			           	alert(data);
			           	console.log($allRate);
			           }
			        });
		        	
		        }else{
		        	alert("Login to rate");	
		        }

		    });
		});

    </script>
		

@endsection
