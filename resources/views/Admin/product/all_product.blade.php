@extends('dashboard_layout')
@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="{{url('/add-product')}}" class="btn btn-info"> Add Product</a></li>
    </ul>
    <p class=" alert-success">
        <?php
        $message=Session::get('message');
        if ($message) {
            echo $message;
            Session::put('message', null);
        }
        ?>
    </p>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Product</h2>

            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th width="">Pro Id.</th>
                        <th width="">Pro Name</th>

                        <th width="10%">Pro Img</th>
                        <th width="">Pr tk</th>
                        <th width="">Cat Nm</th>
                        <th width="">Manufa Nm</th>
                        <th width="">Pro Sts</th>
                        <th width="">Action</th>
                    </tr>
                    </thead>
                    @foreach($all_product_info as  $v_product)
                    <tbody>
                    <tr>
                        <td>{{$v_product->product_id}}</td>
                        <td class="center">{{$v_product->product_name}}</td>

                        <td class="center"><img src="{{url($v_product->product_image)}}" style="height: 80px; width: 80px" alt=""></td>
                        <td class="center">{{$v_product->product_price}}</td>
                        <td class="center">{{$v_product->category_name}}</td>
                        <td class="center">{{$v_product->manufacture_name}}</td>
                        <td class="center">
                            @if($v_product->publication_status==1)
                               <span class="label label-success">Active</span>
                            @else
                                <span class="label label-warning">Inactive</span>
                            @endif
                        </td>
                        <td class="center">
                            @if($v_product->publication_status==1)
                                <a class="btn btn-danger" href="{{url('/unactive-product/'.$v_product->product_id)}}">
                                     <i class="halflings-icon white thumbs-down"></i>
                                 </a>
                            @else
                                <a class="btn btn-success" href="{{url('/active-product/'.$v_product->product_id)}}">
                                    <i class="halflings-icon white thumbs-up"></i>
                                </a>
                            @endif
                            <a class="btn btn-info" href="{{url('/edit-product/'.$v_product->product_id)}}">
                                <i class="halflings-icon white edit"></i>
                            </a>
                            <a class="btn btn-danger" href="{{url('/delete-product/'.$v_product->product_id)}}">
                                <i class="halflings-icon white trash"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div><!--/span-->
@endsection
