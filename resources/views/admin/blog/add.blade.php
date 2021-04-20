@extends('admin.layouts.app')

@section('content')
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4 class="card-title">Default Forms</h4>
                            <h5 class="card-subtitle"> All bootstrap element classies </h5>
                            <?php if($errors->any()){ ?>
                                <?php 
                                    foreach ($errors->all() as $error) {
                                        # code...
                                        echo '<p class="text-danger">' .$error. '</p>';
                                    }
                                ?>
                            <?php } ?>
                            <form enctype="multipart/form-data" method="post" class="form-horizontal m-t-30">
                                @csrf
                                <div class="form-group">
                                    <label>Title <span class="help"></span></label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group">
                                    <label>Description<span class="help"></span></label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Content<span class="help"></span></label>
                                    <textarea class="form-control" id="demo" name="content"></textarea>
                                </div>

                                
                                <button type="submit" class="btn btn-success">Add</button>

                            </form>
                        </div>
                    </div>
                </div>

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace( 'content', {
        filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    } );


 </script>
@endsection


