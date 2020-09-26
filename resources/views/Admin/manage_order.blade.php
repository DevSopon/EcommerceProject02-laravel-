@extends('dashboard_layout')
@section('admin_content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Order Details</a></li>
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
                <h2><i class="halflings-icon user"></i><span class="break"></span> All Order</h2>

            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th width="">Order Id.</th>
                        <th width="">Customer Name</th>
                        <th width="">Order total</th>
                        <th width=""> Status</th>
                        <th width="">Actions</th>
                    </tr>
                    </thead>
                    @foreach($all_order_info as  $v_order)
                        <tbody>
                        <tr>
                            <td>{{$v_order->order_id}}</td>
                            <td class="center">{{$v_order->customer_name}}</td>
                            <td class="center"> {{$v_order->order_total}}</td>
                            <td class="center"> {{$v_order->order_status}}</td>

                            <td class="center">

                                <a class="btn btn-danger" href="{{url('/unactive/'.$v_order->order_id)}}">
                                        <i class="halflings-icon white thumbs-down"></i>
                                </a>



                                <a class="btn btn-info" href="{{url('/edit/'.$v_order->order_id)}}">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="{{url('/delete/'.$v_order->order_id)}}">
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