@extends('admin.layouts.app')
<?php

   
    
?>
@section('content')

	<div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                        {{session('success')}}
                    </div>
                @endif
                <h4 class="card-title">Table Header</h4>
                <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Description</th>
                            <th scope="col">Content</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        foreach ($data as $key => $value) {
                        ?>
                                    <tr role="row">
                                        <td> {{$value->id}}</td>
                                        <td>{{$value->title}}</td>
                                        <td>{{$value->image}}</td>
                                        <td>{{$value->description}}</td>
                                        <td>{{$value->content}}</td>

                                        <td><a href="{{ url('/admin/blog/edit/'.$value->id) }}"><i class="m-r-10 mdi mdi-account-edit"></i>Edit</a></td>                            
                                        <td><a href="{{ url('/admin/blog/delete/'.$value->id) }}"><i class="m-r-10 mdi mdi-delete"></i>Delete</a></td>
                                    </tr> 
                        <?php
                                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a class="btn btn-success" href="{{ url('admin/blog/add') }}">Add blog</a>

</div>
@endsection
