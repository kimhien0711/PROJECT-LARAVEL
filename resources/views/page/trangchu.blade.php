@extends('index')

@section('content')

    <!-- Slider -->
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer">
                <div class="banner">
                    <ul>
                        @foreach($slide as $sl)
                            <!-- THE FIRST SLIDE -->
                            <!-- <p>{{ $sl }}</p> -->
                            <li data-transition="boxfade" data-slotamount="20" class="active-revslide"
                                style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined"
                                    data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined"
                                    data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined"
                                    data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined"
                                    data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined"
                                    data-oheight="undefined">
                                    <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover"
                                        data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined"
                                        src="source/image/slide/{{$sl->image}}" data-src="source/image/slide/{{$sl->image}}"
                                        style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('source/image/slide/{{$sl->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="tp-bannertimer"></div>
        </div>
    </div>
    <!--slider-->

    <!-- End Slider -->

    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>

                @foreach([['Sản phẩm mới', $new_product], ['Sản phẩm khuyến mãi', $promotion_product]] as [$title, $products])
                    <div class="beta-products-list">
                        <h4>{{ $title }}</h4>
                        <p class="pull-left">{{ count($products) }} sản phẩm được tìm thấy</p>
                        <div class="clearfix"></div>

                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-sm-3">
                                    <div class="single-item">
                                        <div class="single-item-header">
                                            <a href="{{ url('detail/' . $product->id) }}">
                                                <img width="200" height="200"
                                                    src="{{ asset('source/image/product/' . $product->image) }}"
                                                    alt="{{ $product->name }}">

                                            </a>
                                        </div>
                                        @if($product->promotion_price != 0)
                                            <div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale</div>
                                            </div>
                                        @endif
                                        <div class="single-item-body">
                                            <p class="single-item-title">{{ $product->name }}</p>
                                            <p class="single-item-price">
                                                @if($product->promotion_price == 0)
                                                    <span class="flash-sale">{{ number_format($product->unit_price) }} Đồng</span>
                                                @else
                                                    <span class="flash-del">{{ number_format($product->unit_price) }} Đồng</span>
                                                    <span class="flash-sale">{{ number_format($product->promotion_price) }} Đồng</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="single-item-caption">
                                            <a class="add-to-cart pull-left" href="{{ route('themgiohang', $product->id) }}">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                            <a class="add-to-wishlist" href="{{ url('wishlist/add/' . $product->id) }}">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                            <a class="beta-btn primary" href="{{ url('detail/' . $product->id) }}">
                                                Details <i class="fa fa-chevron-right"></i>
                                            </a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row">{{ $products->links("pagination::bootstrap-4") }}</div>
                    </div>
                    <div class="space50">&nbsp;</div>
                @endforeach
            </div>
        </div>
    </div>

@endsection