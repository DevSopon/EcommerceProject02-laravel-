@extends ('frontend')
@section ('content')
    <div class="col-sm-9 padding-right">
        <div class="product-details"><!--product-details-->
            <div class="col-sm-5">
                <div class="view-product">
                    <img src="{{url($product_by_details->product_image)}}" style="height: 300px;" alt="" />
                    <h3>ZOOM</h3>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="product-information"><!--/product-information-->
                    <img src="" class="newarrival" alt="" />
                    <h2>{{$product_by_details->product_name}}</h2>
                    <p>Color:{{$product_by_details->product_color}}</p>
                    <img src="{{asset('frontend/images/product-details/rating.png')}}" alt="" />
                    <span>
                        <span>Product Price: {{$product_by_details->product_price}} tk.</span>
                        <form action="{{url('/add-to-cart')}}" method="post">
                            @csrf
                            <label>Quantity:</label>
                            <input name="qty" type="text" value="1" />
                            <input type="hidden"  name="product_id" value="{{$product_by_details->product_id}}" />
                            <button type="submit" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>Add to cart
                            </button>
                        </form>
                    </span>
                    <p><b>Brand:{{$product_by_details->manufacture_name}}</b> </p>
                    <p><b>Category:{{$product_by_details->category_name}}</b></p>
                    <p><b>Size:{{$product_by_details->product_size}}</b> </p>
                    <a href=""><img src="{{asset('frontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
                </div><!--/product-information-->
            </div>
        </div><!--/product-details-->

        <div class="category-tab shop-details-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li><a href="#details" data-toggle="tab">Details</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade" id="details" >
                    <p>{{$product_by_details->product_short_description}}</p>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{url($product_by_details->product_image)}}" style="height: 100px;" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!--/category-tab-->

@endsection
