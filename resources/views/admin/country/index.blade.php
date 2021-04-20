
@extends('admin.layouts.app')

@section('content')
<?php 
    $data = DB::table('country')->get();
    $html = '';
        foreach ($data as $key => $value) {
        
        $html .= '
        <tr role="row">
            <td>'.$value->id.'</td>
            <td>'.$value->name.'</td>                                        
            <td><a href="delete?id='.$value->id.'"> Delete</a></td>
        </tr> ';
    }
?>
	<div class="col-12">
        <div class="card">
            
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <?php echo $html ?>
                            
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a class="btn btn-success" href="{{ url('admin/country/add') }}">Add country</a>

</div>
@endsection
