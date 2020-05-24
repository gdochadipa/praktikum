@extends('components.user.app')
@section('title')
    Dashboard
@endsection
@section('component')
 <!-- slider Area Start -->
        
        <!-- slider Area End-->
 
        <!-- Latest Products Start -->
        <section class="latest-product-area padding-bottom">
            <div class="container">
                <div class="row product-btn d-flex justify-content-end align-items-end">
                    <!-- Section Tittle -->
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="section-tittle mb-30">
                            <h2>Our Products</h2>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="properties__button f-right">
                            <!--Nav Button  -->
                            <nav>                                                                                                
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">All</a>
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                         
                        <div class="row">
                             @foreach ($product as $item)  
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        @php
                                            $image = DB::table('product_images')->where('product_id','=',$item->id)->get();
                                        @endphp
                                        <img src="{{asset('product_images/'.$image[0]->image_name)}}" alt="">
                                        
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i<$item->product_rate)
                                                    
                                                     <i class="far fa-star"></i>
                                                @else
                                                     <i class="far fa-star low-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                      <h4><a href="{{route('detail_product',['id'=>$item->id])}}">{{$item->product_name}}</a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>Rp. {{$item->price}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach
                           
                        </div>
                    </div>

                    
                </div>
                <!-- End Nav Card -->
            </div>
        </section>
        <!-- Latest Products End -->
       
        <!-- Shop Method Start-->
        <div class="shop-method-area section-padding30">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-package"></i>
                            <h6>Free Shipping Method</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-unlock"></i>
                            <h6>Secure Payment System</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div> 
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="single-method mb-40">
                            <i class="ti-reload"></i>
                            <h6>Secure Payment System</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Method End-->

@endsection