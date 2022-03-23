    @extends('site.app')
    @section('content')
    <!-- Start Loading -->
<section class="loading-overlay">
	<div class="Loading-Page">
		<h1 class="loader">Loading...</h1>
	</div>
</section>
<!-- End Loading  -->

<!-- start main content -->
<main class="main-container">

	<!-- new collection directory -->
	<section id="content-block" class="slider_area">
		<div class="container">
			<div class="content-push">
				<div class="row">

					<div class="col-md-3 col-md-push-9">
						<div class="sidebar-navigation">
							<div class="title">Novi proizvodi<i class="fa fa-angle-down"></i></div>
							<div class="list">
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Evening dresses</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Jackets and coats</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Tops and Sweatshirts</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Blouses and shirts</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Trousers and Shorts</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Evening dresses</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Jackets and coats</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Tops and Sweatshirts</span></a>
								<a class="entry" href="#"><span><i class="fa fa-angle-right"></i>Blouses and shirts</span></a>
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="col-md-9 col-md-pull-3">

						<div class="header_slider">
							<article class="boss_slider">
								<div class="tp-banner-container">
									<div class="tp-banner tp-banner0">
										<ul>
											@foreach ($categories as $category)
												@if ($category->category_image)
												<li data-link="#" data-target="_self" data-transition="flyin" data-slotamount="7" data-masterspeed="500" data-saveperformance="on">
													<!-- MAIN IMAGE --><img src="{{ Storage::disk('s3')->temporaryUrl($category->category_image->path, '+2 minutes') }}" alt="slidebg1" data-lazyload="{{ Storage::disk('s3')->temporaryUrl($category->category_image->path, '+2 minutes') }}" data-bgposition="left center" data-kenburns="off" data-duration="14000" data-ease="Linear.easeNone" data-bgpositionend="right center" />
													<!-- LAYER NR. 1 -->
													<div class="tp-caption very_big_white randomrotate customout rs-parallaxlevel-0" data-x="270" data-y="140" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="500" data-end="4800" data-endspeed="300" data-easing="easeInOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> {{ $category->category_translation->name }} </div>
													<!-- LAYER NR. 2 -->
													<div class="tp-caption very_large_white_text randomrotate customout rs-parallaxlevel-0" data-x="270" data-y="250" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="800" data-end="4800" data-endspeed="300" data-easing="easeInOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> Kolekcija </div>
													<!-- LAYER NR. 3 -->
													<div class="tp-caption large_white_text randomrotate customout rs-parallaxlevel-0" data-x="355" data-y="363" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="300" data-start="1200" data-end="4800" data-endspeed="300" data-easing="easeInOutBack" data-endeasing="easeOutBack" data-elementdelay="0.1" data-endelementdelay="0.1" style="z-index: 2;"> KUPUJ </div>

												</li>
												@endif
											@endforeach
										</ul>
										<div class="slideshow_control"></div>
									</div><!-- /.tp-banner -->
								</div>
							</article>
						</div><!-- /.header_slider -->

						<div class="clear"></div>

					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- end new collection directory -->



<section id="popular-product" class="ecommerce">
	<div class="container">
		<!-- Shopping items content -->
		<div class="shopping-content">

			<!-- Block heading two -->
			<div class="block-heading-two">
				<h3><span>Popularni proizvodi</span></h3>
			</div>

			<div class="row">
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="single-product.html"><img class="img-responsive" src="img/product/shop_item_01.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a href="single-product.html">Brown Mini Skirt</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="single-product.html"><img class="img-responsive" src="img/product/shop_item_03.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a href="single-product.html">Wool Two-Piece Suit</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
						<!-- Hot tag -->
						<span class="hot-tag bg-red">NEW</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="single-product.html"><img class="img-responsive" src="img/product/shop_item_05.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a href="single-product.html">Vintage Sunglasses</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="single-product.html"><img class="img-responsive" src="img/product/shop_item_08.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a href="single-product.html">Nulla luctus</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
						<!-- Hot tag -->
						<span class="hot-tag bg-lblue">HOT</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="single-product.html"><img class="img-responsive" src="img/product/shop_item_02.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a title="Glory High Shoes" href="single-product.html">Glory High Shoes</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
						<!-- Hot tag -->
						<span class="hot-tag bg-red">NEW</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="#"><img class="img-responsive" src="img/product/shop_item_04.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a title="Vintage Stripe Jumper" href="#">Vintage Stripe Jumper</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="single-product.html"><img class="img-responsive" src="img/product/shop_item_06.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a href="single-product.html">Solid Blue Polo Shirt</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="#"><img class="img-responsive" src="img/product/shop_item_09.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a title="Nulla luctus" href="#">Nulla luctus</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
						<!-- Hot tag -->
						<span class="hot-tag bg-green">HOT</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="#"><img class="img-responsive" src="img/product/product_item_01c.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a href="#">Quasi Architects</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="single-product.html"><img class="img-responsive" src="img/product/product_item_02a.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a href="single-product.html">Quasi Architects</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="single-product.html"><img class="img-responsive" src="img/product/product_item_01b.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a href="single-product.html">Quasi Architects</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<!-- Shopping items -->
					<div class="shopping-item">
						<!-- Image -->
						<a href="single-product.html"><img class="img-responsive" src="img/product/product_item_01b.jpg" alt="" /></a>
						<!-- Shopping item name / Heading -->
						<h4><a href="single-product.html">Quasi Architects</a><span class="color pull-right">$49</span></h4>
						<div class="clearfix"></div>
						<!-- Buy now button -->
						<div class="visible-xs">
							<a class="btn btn-color btn-sm" href="#">Buy Now</a>
						</div>
						<!-- Shopping item hover block & link -->
						<div class="item-hover bg-color hidden-xs">
							<a href="#">Add to cart</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Pagination -->
			<div class="shopping-pagination pull-right">
				<ul class="pagination">
					<li class="disabled"><a href="#">&laquo;</a></li>
					<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul>
			</div>
			<!-- Pagination end-->
		</div>
	</div>
</section>


	<!-- Start Our Shop Items -->

	<!-- Recent items Starts -->
	<section id="recent-product">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<section class="related-products">



						<!-- Block heading two -->
						<div class="block-heading-two">
							<h3><span>Preporučeni proizvodi</span></h3>
						</div>

						<div class="related-products-wrapper">

							<div class="related-products-carousel">

								<div class="product-control-nav">
									<a class="prev"><i class="fa fa-angle-left"></i></a>
									<a class="next"><i class="fa fa-angle-right"></i></a>
								</div>


								<div class="row product-listing">
									<div id="product-carousel" class="product-listing">

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_2_front-300x300.jpg" class="img-responsive" alt="T_2_front">
													</a>
													<figcaption><span class="amount">$20.00</span></figcaption>
												</figure>

												<h4 class="title"><a href="#">Premium Quality</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_5_front-300x300.jpg" class="img-responsive " alt="T_5_front">
													</a>
													<figcaption><span class="amount">$20.00</span></figcaption>
												</figure>


												<h4 class="title"><a href="#">Ninja Silhouette</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/hoodie_2_front-300x300.jpg" class="img-responsive" alt="hoodie_2_front">
													</a>
													<figcaption><span class="amount">$35.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Woo Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_4_front-300x300.jpg" class="img-responsive" alt="T_4_front">
													</a>
													<figcaption>
														<span class="amount">$20.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Ship Your Idea</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_7_front-300x300.jpg" class="img-responsive" alt="T_7_front">
													</a>
													<figcaption><span class="amount">$18.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Happy Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/T_6_front-300x300.jpg" class="img-responsive" alt="T_6_front">
													</a>
													<figcaption><span class="amount">$20.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Woo Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/hoodie_4_front-300x300.jpg" class="img-responsive" alt="hoodie_4_front">
													</a>
													<figcaption><span class="amount">$35.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Happy Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>

										<div class="product  item first ">

											<article>


												<figure>
													<a href="#">
														<img src="img/temp-images/hoodie_3_front-300x300.jpg" class="img-responsive" alt="hoodie_3_front">
													</a>
													<figcaption><span class="amount">$35.00</span></figcaption>
												</figure>




												<h4 class="title"><a href="#">Patient Ninja</a></h4>


												<a href="#" class="button-add-to-cart">Add to cart</a>
											</article>

										</div>
									</div>

								</div>
							</div>

						</div>

					</section>
				</div>
			</div>
		</div>
	</section>

	<!-- Recent items Ends -->


	<div class="bt-block-home-parallax" style="background-image: url(img/resource/parallax2.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="lookbook-product">
						<h2><a href="#" title="">Blog </a></h2>
						<ul class="simple-cat-style">
							<li><a href="#" title="">Čitajte naš blog</a></li>
							<li><a href="#" title="">Saznajte najbolje popuste na našem webshopu</a></li>
						</ul>
						<a href="#" title="">Blogovi</a>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.bt-block-home-parallax -->

	<!-- Start Our Clients -->

	<section id="Clients" class="light-wrapper">
		<div class="container inner">
			<div class="row">
				<div class="Last-items-shop col-md-4 col-sm-6">
					<!-- Block heading two -->
					<div class="block-heading-two block-heading-three">
						<h3><span>Najprodavanije</span></h3>
					</div>
					<!--<div class="Top-Title-SideBar">
						<h3>Best Sellers</h3>
					</div>-->
					<div class="Last-post">
						<ul class="shop-res-items">
							<li>
								<a href="#"><img src="img/small/53.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$28.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/54.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$40.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/55.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$150.00</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="Last-items-shop col-md-4 col-sm-6">
					<!-- Block heading two -->
					<div class="block-heading-two block-heading-three">
						<h3><span>Preporuka</span></h3>
					</div>
					<!--<div class="Top-Title-SideBar">
						<h3>Featured</h3>
					</div>-->
					<div class="Last-post">
						<ul class="shop-res-items">
							<li>
								<a href="#"><img src="img/small/56.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$28.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/57.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$40.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/55.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$150.00</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="Last-items-shop col-md-4 col-sm-12">
					<!-- Block heading two -->
					<div class="block-heading-two block-heading-three">
						<h3><span>Popusti</span></h3>
					</div>
					<!--<div class="Top-Title-SideBar">
						<h3>Sales</h3>
					</div>-->
					<div class="Last-post">
						<ul class="shop-res-items">
							<li>
								<a href="#"><img src="img/small/55.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$28.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/58.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$40.00</span>
							</li>
							<li>
								<a href="#"><img src="img/small/50.jpg" alt=""></a>
								<h6><a href="#">Stockholm Chair high Mosta gruancy</a></h6>
								<span class="sale-date">$150.00</span>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- End Our Clients  -->

</main>
<!-- end main content -->

@endsection