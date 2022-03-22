<div class="navi">
    <div class="container">
        <div class="navy">
            <ul>
                <!-- Main menu -->
                <li><a href="{{ route('home') }}">Početna</a></li>

                <li><a href="#">Features</a>
                    <ul>
                        <li><a href="#">Footer</a>
                            <ul>
                                <li><a href="footer-one.html">Footer1</a></li>
                                <li><a href="footer-two.html">Footer2</a></li>
                                <li><a href="footer-three.html">Footer3</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Price Table</a>
                            <ul>
                                <li><a href="price-table-one.html">Price Table1</a></li>
                                <li><a href="price-table-two.html">Price Table2</a></li>

                            </ul>
                        </li>

                    </ul>
                </li>

                @foreach ($categories as $category)
                <li><a href="#">{{ $category->category_translation->name }}</a>@if (count($category->children) > 0)
                    <ul>
                        <li><a href="#">{{ $category->category_translation->name }}</a></li>
                    </ul>
                </li>
                    @else
                </li>
                @endif
                @endforeach
                
                    <ul>
                        <li><a href="#">Laptop</a>
                            <ul>
                                <li><a href="#">Vaio</a></li>
                                <li><a href="#">Samsung</a></li>
                                <li><a href="#">Toshiba</a></li>
                                <li><a href="#">HP</a></li>

                            </ul>
                        </li>
                        <li><a href="#">Smartphone</a>
                            <ul>
                                <li><a href="#">Iphone</a></li>
                                <li><a href="#">Oppo</a></li>
                                <li><a href="#">Nokia</a></li>
                                <li><a href="#">Sony</a></li>
                                <li><a href="#">Samsung</a></li>

                            </ul>
                        </li>
                        <li><a href="#">Accessories</a>
                            <ul>
                                <li><a href="#">Headphone</a></li>
                                <li><a href="#">Adapter</a></li>
                                <li><a href="#">Bag</a></li>
                                <li><a href="#">Baby doll</a></li>

                            </ul>
                        </li>
                        <!-- Multi level menu -->
                        <li><a href="#">Multi Level Menu</a>
                            <ul>
                                <!-- Sub menu -->
                                <li><a href="#">Menu #1</a></li>
                                <li><a href="#">Menu #1</a></li>
                                <li><a href="#">Menu #1</a>
                                    <ul>
                                        <!-- Sub menu -->
                                        <li><a href="#">Menu #2</a></li>
                                        <li><a href="#">Menu #2</a></li>
                                        <li><a href="#">Menu #2</a>
                                            <ul>
                                                <!-- Sub menu -->
                                                <li><a href="#">Menu #3</a></li>
                                                <li><a href="#">Menu #3</a></li>
                                                <li><a href="#">Menu #3</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li><a href="#">Blog</a>
                    <ul>
                        <li><a href="blog.html"><span>Blog Default</span></a></li>
                        <li><a href="blog-masonry.html"><span>Blog Masonry</span></a></li>
                        <li><a href="blog-full-width.html"><span>Blog Full Width</span></a></li>
                        <li><a href="single-post.html"><span>Single Page 1</span></a></li>
                        <li><a href="single-post-v2.html"><span>Single Page 2</span></a></li>
                    </ul>
                </li>

                <li><a href="#">Pages</a>
                    <ul>
                        <li><a href="shop.html"><span>Shop</span></a></li>
                        <li><a href="single-product.html"><span>Single product</span></a></li>
                        <li><a href="shopping-cart.html"><span>Cart</span></a></li>
                        <li><a href="checkout.html"><span>Checkout</span></a></li>
                        <li><a href="wishlist.html"><span>Wishlist</span></a></li>
                        <li><a href="signin.html"><span>Sign In</span></a></li>
                        <li><a href="signup.html"><span>Sign Up</span></a></li>
                        <li><a href="404.html"><span>404 Page</span></a></li>
                    </ul>
                </li>

                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>