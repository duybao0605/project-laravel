@extends('frontend.layouts.app')
@section('content')
	<div class="container">
    @foreach ($blogs as $blog)
    	


    
        <div class="single-blog-post">
			<h3>{{ $blog->title }}</h3>
			<div class="post-meta">
				<!-- <ul>
					<li><i class="fa fa-user"></i> Mac Doe</li>
					<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
					<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
				</ul> -->
				<span>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-half-o"></i>
				</span>
			</div>
			<a href="{{ url('blog/detail/'.$blog->id) }}">
				<img width="847.5px" height="388.63px	" src="/upload/user/blog-img/<?php echo $blog->image ?>" alt="">
			</a>
			<p>{{ $blog->description }}</p>
			<a  class="btn btn-primary" href="{{ url('blog/detail/'.$blog->id) }}">Read More</a>
		</div>
    @endforeach


    {!! $blogs->links() !!}

</div>


 
@endsection
