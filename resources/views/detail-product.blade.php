@extends('layouts.front')
@section('content')
<!-- page main wrapper start -->
<div class="shop-main-wrapper section-padding pb-0">
    <div class="container">
        <div class="row">
            <!-- product details wrapper start -->
            <div class="col-lg-12 order-1 order-lg-2">
                <!-- product details inner end -->
                <div class="product-details-inner">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="product-large-slider">
                                <div class="pro-large-img img-zoom">
                                    <img src="{{asset('storage/images/products/'.$first_image->lien)}}" alt="product-details" />
                                </div>
                                @if($images_attributes)
                                   @foreach($images_attributes as $image_attribute)
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{asset('storage/images/productlines/'.$image_attribute->attribute_image)}}" alt="product-details" />
                                    </div>
                                    @endforeach
                                @else
                                    @foreach($secondary_images as $secondary_image)
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{asset('storage/images/products/'.$secondary_image->lien)}}" alt="product-details" />
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="pro-nav slick-row-10 slick-arrow-style">
                                @if($images_attributes)
                                    <div class="pro-nav-thumb">
                                        <img src="{{asset('storage/images/products/'.$first_image->lien)}}" alt="product-details" />
                                    </div>
                                    @foreach($images_attributes as $image_attribute)
                                    <div class="pro-nav-thumb">
                                        <img src="{{asset('storage/images/productlines/'.$image_attribute->attribute_image)}}" alt="product-details" />
                                    </div>
                                    @endforeach
                                @else
                                    @foreach($images as $image)
                                    <div class="pro-nav-thumb">
                                        <img src="{{asset('storage/images/products/'.$image->lien)}}" alt="product-details" />
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-details-des">
                                <div class="manufacturer-name">
                                    <a href="product-details.html">HasTech</a>
                                </div>
                                <h3 class="product-name">{{ $product->designation }}</h3>
                                <div class="ratings d-flex">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <div class="pro-review">
                                        <span>1 Reviews</span>
                                    </div>
                                </div>
                                <div class="price-box">
                                    @if($min_price)
                                        @if($min_price_promo)
                                        <span class="price-regular">{{number_format($min_price_promo)}} Da</span>
                                        <span class="price-old"><del>{{number_format($min_price)}} Da</del></span>
                                        @else
                                        <span class="price-regular">{{number_format($min_price)}} Da</span>
                                        @endif
                                    @else
                                        @if($product_line->promo_price)
                                        <span class="price-regular">{{number_format($product_line->promo_price)}} Da</span>
                                        <span class="price-old"><del>{{number_format($product_line->price)}} Da</del></span>
                                        @else
                                        <span class="price-regular">{{number_format($product_line->price)}} Da</span>
                                        @endif
                                    @endif
                                </div>
                                <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                                <div class="product-countdown" data-countdown="2022/12/30"></div>
                                <div class="availability">
                                    <i class="fa fa-check-circle"></i>
                                    <span>200 in stock</span>
                                </div>
                                <p class="pro-desc">{{$product->short_description}}</p>
                                <div class="quantity-cart-box d-flex align-items-center">
                                    <h6 class="option-title">qty:</h6>
                                    <div class="quantity">
                                        <div class="pro-qty"><input type="text" value="1"></div>
                                    </div>
                                    <div class="action_link">
                                        <a class="btn btn-cart2" href="#">Add to cart</a>
                                    </div>
                                </div>
                                <div class="pro-size">
                                    <h6 class="option-title">size :</h6>
                                    <select class="nice-select">
                                        <option>S</option>
                                        <option>M</option>
                                        <option>L</option>
                                        <option>XL</option>
                                    </select>
                                </div>
                                @if($productlines)
                                    <div class="color-option">
                                        <h6 class="option-title">Couleur :</h6>
                                        <ul class="color-categories">
                                            @foreach($productlines as $productline)
                                            <li>
                                                <a href="#" title="LightSteelblue"><img src="{{ asset('storage/icones/productlines/'.$productline->attribute_icone) }}" alt="product-details" /></a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="useful-links">
                                    <a href="#" data-bs-toggle="tooltip" title="Compare"><i
                                            class="pe-7s-refresh-2"></i>compare</a>
                                    <a href="#" data-bs-toggle="tooltip" title="Wishlist"><i
                                            class="pe-7s-like"></i>wishlist</a>
                                </div>
                                <div class="like-icon">
                                    <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                    <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                    <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details inner end -->

                <!-- product details reviews start -->
                <div class="product-details-reviews section-padding pb-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-review-info">
                                <ul class="nav review-tab">
                                    <li>
                                        <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tab" href="#tab_two">information</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tab" href="#tab_three">reviews (1)</a>
                                    </li>
                                </ul>
                                <div class="tab-content reviews-tab">
                                    <div class="tab-pane fade show active" id="tab_one">
                                        <div class="tab-one">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                                fringilla augue nec est tristique auctor. Ipsum metus feugiat
                                                sem, quis fermentum turpis eros eget velit. Donec ac tempus
                                                ante. Fusce ultricies massa massa. Fusce aliquam, purus eget
                                                sagittis vulputate, sapien libero hendrerit est, sed commodo
                                                augue nisi non neque.Cras neque metus, consequat et blandit et,
                                                luctus a nunc. Etiam gravida vehicula tellus, in imperdiet
                                                ligula euismod eget. Pellentesque habitant morbi tristique
                                                senectus et netus et malesuada fames ac turpis egestas. Nam
                                                erat mi, rutrum at sollicitudin rhoncus</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab_two">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>color</td>
                                                    <td>black, blue, red</td>
                                                </tr>
                                                <tr>
                                                    <td>size</td>
                                                    <td>L, M, S</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab_three">
                                        <form action="#" class="review-form">
                                            <h5>1 review for <span>Chaz Kangeroo</span></h5>
                                            <div class="total-reviews">
                                                <div class="rev-avatar">
                                                    <img src="assets/img/about/avatar.jpg" alt="">
                                                </div>
                                                <div class="review-box">
                                                    <div class="ratings">
                                                        <span class="good"><i class="fa fa-star"></i></span>
                                                        <span class="good"><i class="fa fa-star"></i></span>
                                                        <span class="good"><i class="fa fa-star"></i></span>
                                                        <span class="good"><i class="fa fa-star"></i></span>
                                                        <span><i class="fa fa-star"></i></span>
                                                    </div>
                                                    <div class="post-author">
                                                        <p><span>admin -</span> 30 Mar, 2019</p>
                                                    </div>
                                                    <p>Aliquam fringilla euismod risus ac bibendum. Sed sit
                                                        amet sem varius ante feugiat lacinia. Nunc ipsum nulla,
                                                        vulputate ut venenatis vitae, malesuada ut mi. Quisque
                                                        iaculis, dui congue placerat pretium, augue erat
                                                        accumsan lacus</p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Your Name</label>
                                                    <input type="text" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Your Email</label>
                                                    <input type="email" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Your Review</label>
                                                    <textarea class="form-control" required></textarea>
                                                    <div class="help-block pt-10"><span
                                                            class="text-danger">Note:</span>
                                                        HTML is not translated!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col">
                                                    <label class="col-form-label"><span class="text-danger">*</span>
                                                        Rating</label>
                                                    &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                    <input type="radio" value="1" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="2" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="3" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="4" name="rating">
                                                    &nbsp;
                                                    <input type="radio" value="5" name="rating" checked>
                                                    &nbsp;Good
                                                </div>
                                            </div>
                                            <div class="buttons">
                                                <button class="btn btn-sqr" type="submit">Continue</button>
                                            </div>
                                        </form> <!-- end of review-form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details reviews end -->
            </div>
            <!-- product details wrapper end -->
        </div>
    </div>
</div>
<!-- page main wrapper end -->

<!-- related products area start -->
<section class="related-products section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">Related Products</h2>
                    <p class="sub-title">Add related products to weekly lineup</p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-11.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-8.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>new</span>
                                </div>
                                <div class="product-label discount">
                                    <span>10%</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Perfect Diamond Jewelry</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$60.00</span>
                                <span class="price-old"><del>$70.00</del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->

                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-12.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-7.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>sale</span>
                                </div>
                                <div class="product-label discount">
                                    <span>new</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">mony</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Handmade Golden Necklace</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$50.00</span>
                                <span class="price-old"><del>$80.00</del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->

                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-13.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-6.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>new</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">Diamond</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Perfect Diamond Jewelry</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$99.00</span>
                                <span class="price-old"><del></del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->

                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-14.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-5.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>sale</span>
                                </div>
                                <div class="product-label discount">
                                    <span>15%</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">silver</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Diamond Exclusive Ornament</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$55.00</span>
                                <span class="price-old"><del>$75.00</del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->

                    <!-- product item start -->
                    <div class="product-item">
                        <figure class="product-thumb">
                            <a href="product-details.html">
                                <img class="pri-img" src="assets/img/product/product-15.jpg" alt="product">
                                <img class="sec-img" src="assets/img/product/product-4.jpg" alt="product">
                            </a>
                            <div class="product-badge">
                                <div class="product-label new">
                                    <span>new</span>
                                </div>
                                <div class="product-label discount">
                                    <span>20%</span>
                                </div>
                            </div>
                            <div class="button-group">
                                <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                            </div>
                            <div class="cart-hover">
                                <button class="btn btn-cart">add to cart</button>
                            </div>
                        </figure>
                        <div class="product-caption text-center">
                            <div class="product-identity">
                                <p class="manufacturer-name"><a href="product-details.html">mony</a></p>
                            </div>
                            <ul class="color-categories">
                                <li>
                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                </li>
                                <li>
                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                </li>
                                <li>
                                    <a class="c-grey" href="#" title="Grey"></a>
                                </li>
                                <li>
                                    <a class="c-brown" href="#" title="Brown"></a>
                                </li>
                            </ul>
                            <h6 class="product-name">
                                <a href="product-details.html">Citygold Exclusive Ring</a>
                            </h6>
                            <div class="price-box">
                                <span class="price-regular">$60.00</span>
                                <span class="price-old"><del>$70.00</del></span>
                            </div>
                        </div>
                    </div>
                    <!-- product item end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- related products area end -->
</main>

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
<i class="fa fa-angle-up"></i>
</div>


@endsection
