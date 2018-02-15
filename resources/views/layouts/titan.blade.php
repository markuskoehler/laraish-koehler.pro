<!DOCTYPE html>
<html lang="en-US" dir="ltr" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, minimum-scale=1, maximum-scale=10, user-scalable=no, initial-scale=1.0">
    <!--
    Document Title
    =============================================
    -->
    <title>Titan | Multipurpose HTML5 Template</title>
    <!--
    Favicons
    =============================================
    -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/images/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicons/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/images/favicons/ms-icon-144x144.png">
    <link rel="shortcut icon" href="{{ public_url('images/favicon.ico') }}" type="image/vnd.microsoft.icon"/>
    <link rel="apple-touch-icon-precomposed" href="{{ public_url('images/apple-touch-icon-precomposed.png') }}">
    <meta name="theme-color" content="#ffffff">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--
    Stylesheets
    =============================================

    -->
    <!-- Default stylesheets-->
    <link href="{{public_url('/assets/lib/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="{{public_url('assets/lib/animate.css/animate.css')}}" rel="stylesheet">
    <link href="{{public_url('assets/lib/components-font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{public_url('assets/lib/et-line-font/et-line-font.css')}}" rel="stylesheet">
    <link href="{{public_url('assets/lib/flexslider/flexslider.css')}}" rel="stylesheet">
    <link href="{{public_url('assets/lib/owl.carousel/dist/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{public_url('assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{public_url('assets/lib/magnific-popup/dist/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{public_url('assets/lib/simple-text-rotator/simpletextrotator.css')}}" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="{{public_url('assets/css/style.css')}}" rel="stylesheet">
    <link id="color-scheme" href="{{public_url('assets/css/colors/default.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ public_url('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ get_stylesheet_uri() }}">

    @yield('head')
	<?php wp_head(); ?>
</head>
<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">

@if(env('APP_ENV')==='production')
    <script>
        // scripts that only should be ran on production server.
    </script>
@endif

<main id="app">
    <div class="page-loader">
        <div class="loader">Loading...</div>
    </div>
    @php
        add_action( 'init', 'register_my_menu' );

    function register_my_menu() {
        register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
    }
            class themeslug_walker_nav_menu extends Walker_Nav_Menu {
                // add classes to ul sub-menus
                function start_lvl( &$output, $depth = 0, $args = array() ) {
                    // depth dependent classes
                    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
                    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
                    $classes = array(
                        'sub-menu',
                        'dropdown-menu',
                        ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
                        ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
                        'menu-depth-' . $display_depth
                        );
                    $class_names = implode( ' ', $classes );

                    // build html
                    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
                }

                // add main/sub classes to li's and links
                 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
                    global $wp_query;

                    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

                    // depth dependent classes
                    $depth_classes = array(
                        ( $depth == 0 ? 'dropdown' : 'dropdown' ),
                        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
                        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
                        'menu-item-depth-' . $depth
                    );
                    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

                    // passed classes
                    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
                    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

                    // build html
                    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

                    // link attributes
                    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
                    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
                    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
                    if($args->walker->has_children) {
                        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '#';
                        $attributes .= ' class="dropdown-toggle menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '" data-toggle="dropdown"';
                    } else {
                        // todo # for parent
                        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
                        // todo dropdown-toggle for parents
                        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
                    }

                    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                        $args->before,
                        $attributes,
                        $args->link_before,
                        apply_filters( 'the_title', $item->title, $item->ID ),
                        $args->link_after,
                        $args->after
                    );

                    // build html
                    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
                }
        }
    @endphp
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <span class="navbar-brand"><a href="{{url('/')}}"><img src="{{public_url('images/mkit-dots.fw.png')}}" alt="Markus Koehler IT Services"></a><span class="slogan">&nbsp;All your web needs.</span></span>
            </div>
            <div class="collapse navbar-collapse" id="custom-collapse">
                {{
                wp_nav_menu( array(
                    //'theme_location' => 'top',
                    //'menu_id'        => 'top-menu',
                    'menu_class'    => 'nav navbar-nav navbar-right',
                    'container'     => '',
                    //'container_id'     => 'custom-collapse',
                    //'container_class'     => 'navbar navbar-custom navbar-fixed-top navbar-transparent',
                    'walker' => new themeslug_walker_nav_menu()
                ) )
                }}
            </div>
        </div>
    </nav>
    {{--<nav class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <span class="navbar-brand"><a href="{{public_url()}}"><img src="{{public_url('images/mkit-dots.fw.png')}}" alt="Markus Koehler IT Services"></a><span class="slogan">&nbsp;All your web needs.</span></span>
            </div>
            <div class="collapse navbar-collapse" id="custom-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Home</a>
                        <ul class="dropdown-menu">
                            <li><a href="index_mp_fullscreen_video_background.html">Default</a></li>
                            <li><a href="index_op_fullscreen_gradient_overlay.html">One Page</a></li>
                            <li><a href="index_agency.html">Agency</a></li>
                            <li><a href="index_portfolio.html">Portfolio</a></li>
                            <li><a href="index_restaurant.html">Restaurant</a></li>
                            <li><a href="index_finance.html">Finance</a></li>
                            <li><a href="index_landing.html">Landing Page</a></li>
                            <li><a href="index_photography.html">Photography</a></li>
                            <li><a href="index_shop.html">Shop</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Headers</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Static Image Header</a>
                                <ul class="dropdown-menu">
                                    <li><a href="index_mp_fullscreen_static.html">Fulscreen</a></li>
                                    <li><a href="index_mp_classic_static.html">Classic</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Flexslider Header</a>
                                <ul class="dropdown-menu">
                                    <li><a href="index_mp_fullscreen_flexslider.html">Fulscreen</a></li>
                                    <li><a href="index_mp_classic_flexslider.html">Classic</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Video Background Header</a>
                                <ul class="dropdown-menu">
                                    <li><a href="index_mp_fullscreen_video_background.html">Fulscreen</a></li>
                                    <li><a href="index_mp_classic_video_background.html">Classic</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Text Rotator Header</a>
                                <ul class="dropdown-menu">
                                    <li><a href="index_mp_fullscreen_text_rotator.html">Fulscreen</a></li>
                                    <li><a href="index_mp_classic_text_rotator.html">Classic</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Gradient Overlay Header</a>
                                <ul class="dropdown-menu">
                                    <li><a href="index_mp_fullscreen_gradient_overlay.html">Fulscreen</a></li>
                                    <li><a href="index_mp_classic_gradient_overlay.html">Classic</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Pages</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">About</a>
                                <ul class="dropdown-menu">
                                    <li><a href="about1.html">About 1</a></li>
                                    <li><a href="about2.html">About 2</a></li>
                                    <li><a href="about3.html">About 3</a></li>
                                    <li><a href="about4.html">About 4</a></li>
                                    <li><a href="about5.html">About 5</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Services</a>
                                <ul class="dropdown-menu">
                                    <li><a href="service1.html">Service 1</a></li>
                                    <li><a href="service2.html">Service 2</a></li>
                                    <li><a href="service3.html">Service 3</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Pricing</a>
                                <ul class="dropdown-menu">
                                    <li><a href="pricing1.html">Pricing 1</a></li>
                                    <li><a href="pricing2.html">Pricing 2</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Gallery</a>
                                <ul class="dropdown-menu">
                                    <li><a href="gallery_col_2.html">2 Columns</a></li>
                                    <li><a href="gallery_col_3.html">3 Columns</a></li>
                                    <li><a href="gallery_col_4.html">4 Columns</a></li>
                                    <li><a href="gallery_col_6.html">6 Columns</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Contact</a>
                                <ul class="dropdown-menu">
                                    <li><a href="contact1.html">Contact 1</a></li>
                                    <li><a href="contact2.html">Contact 2</a></li>
                                    <li><a href="contact3.html">Contact 3</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Restaurant menu</a>
                                <ul class="dropdown-menu">
                                    <li><a href="restaurant_menu1.html">Menu 2 Columns</a></li>
                                    <li><a href="restaurant_menu2.html">Menu 3 Columns</a></li>
                                </ul>
                            </li>
                            <li><a href="login_register.html">Login / Register</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="404.html">Page 404</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Portfolio</a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed</a>
                                <ul class="dropdown-menu">
                                    <li><a href="portfolio_boxed_col_2.html">2 Columns</a></li>
                                    <li><a href="portfolio_boxed_col_3.html">3 Columns</a></li>
                                    <li><a href="portfolio_boxed_col_4.html">4 Columns</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed - Gutter</a>
                                <ul class="dropdown-menu">
                                    <li><a href="portfolio_boxed_gutter_col_2.html">2 Columns</a></li>
                                    <li><a href="portfolio_boxed_gutter_col_3.html">3 Columns</a></li>
                                    <li><a href="portfolio_boxed_gutter_col_4.html">4 Columns</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width</a>
                                <ul class="dropdown-menu">
                                    <li><a href="portfolio_full_width_col_2.html">2 Columns</a></li>
                                    <li><a href="portfolio_full_width_col_3.html">3 Columns</a></li>
                                    <li><a href="portfolio_full_width_col_4.html">4 Columns</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width - Gutter</a>
                                <ul class="dropdown-menu">
                                    <li><a href="portfolio_full_width_gutter_col_2.html">2 Columns</a></li>
                                    <li><a href="portfolio_full_width_gutter_col_3.html">3 Columns</a></li>
                                    <li><a href="portfolio_full_width_gutter_col_4.html">4 Columns</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Masonry</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="portfolio_masonry_boxed_col_2.html">2 Columns</a></li>
                                            <li><a href="portfolio_masonry_boxed_col_3.html">3 Columns</a></li>
                                            <li><a href="portfolio_masonry_boxed_col_4.html">4 Columns</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="portfolio_masonry_full_width_col_2.html">2 Columns</a></li>
                                            <li><a href="portfolio_masonry_full_width_col_3.html">3 Columns</a></li>
                                            <li><a href="portfolio_masonry_full_width_col_4.html">4 Columns</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Hover Style</a>
                                <ul class="dropdown-menu">
                                    <li><a href="portfolio_hover_black.html">Black</a></li>
                                    <li><a href="portfolio_hover_gradient.html">Gradient</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Single</a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Image</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="portfolio_single_featured_image1.html">Style 1</a></li>
                                            <li><a href="portfolio_single_featured_image2.html">Style 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Slider</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="portfolio_single_featured_slider1.html">Style 1</a></li>
                                            <li><a href="portfolio_single_featured_slider2.html">Style 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Video</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="portfolio_single_featured_video1.html">Style 1</a></li>
                                            <li><a href="portfolio_single_featured_video2.html">Style 2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Blog</a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Standard</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_standard_left_sidebar.html">Left Sidebar</a></li>
                                    <li><a href="blog_standard_right_sidebar.html">Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Grid</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_grid_col_2.html">2 Columns</a></li>
                                    <li><a href="blog_grid_col_3.html">3 Columns</a></li>
                                    <li><a href="blog_grid_col_4.html">4 Columns</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Masonry</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_grid_masonry_col_2.html">2 Columns</a></li>
                                    <li><a href="blog_grid_masonry_col_3.html">3 Columns</a></li>
                                    <li><a href="blog_grid_masonry_col_4.html">4 Columns</a></li>
                                </ul>
                            </li>
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Single</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog_single_left_sidebar.html">Left Sidebar</a></li>
                                    <li><a href="blog_single_right_sidebar.html">Right Sidebar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Features</a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="alerts-and-wells.html"><i class="fa fa-bolt"></i> Alerts and Wells</a></li>
                            <li><a href="buttons.html"><i class="fa fa-link fa-sm"></i> Buttons</a></li>
                            <li><a href="tabs_and_accordions.html"><i class="fa fa-tasks"></i> Tabs &amp; Accordions</a></li>
                            <li><a href="content_box.html"><i class="fa fa-list-alt"></i> Contents Box</a></li>
                            <li><a href="forms.html"><i class="fa fa-check-square-o"></i> Forms</a></li>
                            <li><a href="icons.html"><i class="fa fa-star"></i> Icons</a></li>
                            <li><a href="progress-bars.html"><i class="fa fa-server"></i> Progress Bars</a></li>
                            <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Shop</a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Product</a>
                                <ul class="dropdown-menu">
                                    <li><a href="shop_product_col_3.html">3 columns</a></li>
                                    <li><a href="shop_product_col_4.html">4 columns</a></li>
                                </ul>
                            </li>
                            <li><a href="shop_single_product.html">Single Product</a></li>
                            <li><a href="shop_checkout.html">Checkout</a></li>
                        </ul>
                    </li>
                    <!--li.dropdown.navbar-cart-->
                    <!--    a.dropdown-toggle(href='#', data-toggle='dropdown')-->
                    <!--        span.icon-basket-->
                    <!--        |-->
                    <!--        span.cart-item-number 2-->
                    <!--    ul.dropdown-menu.cart-list(role='menu')-->
                    <!--        li-->
                    <!--            .navbar-cart-item.clearfix-->
                    <!--                .navbar-cart-img-->
                    <!--                    a(href='#')-->
                    <!--                        img(src='assets/images/shop/product-9.jpg', alt='')-->
                    <!--                .navbar-cart-title-->
                    <!--                    a(href='#') Short striped sweater-->
                    <!--                    |-->
                    <!--                    span.cart-amount 2 &times; $119.00-->
                    <!--                    br-->
                    <!--                    |-->
                    <!--                    strong.cart-amount $238.00-->
                    <!--        li-->
                    <!--            .navbar-cart-item.clearfix-->
                    <!--                .navbar-cart-img-->
                    <!--                    a(href='#')-->
                    <!--                        img(src='assets/images/shop/product-10.jpg', alt='')-->
                    <!--                .navbar-cart-title-->
                    <!--                    a(href='#') Colored jewel rings-->
                    <!--                    |-->
                    <!--                    span.cart-amount 2 &times; $119.00-->
                    <!--                    br-->
                    <!--                    |-->
                    <!--                    strong.cart-amount $238.00-->
                    <!--        li-->
                    <!--            .clearfix-->
                    <!--                .cart-sub-totle-->
                    <!--                    strong Total: $476.00-->
                    <!--        li-->
                    <!--            .clearfix-->
                    <!--                a.btn.btn-block.btn-round.btn-font-w(type='submit') Checkout-->
                    <!--li.dropdown-->
                    <!--    a.dropdown-toggle(href='#', data-toggle='dropdown') Search-->
                    <!--    ul.dropdown-menu(role='menu')-->
                    <!--        li-->
                    <!--            .dropdown-search-->
                    <!--                form(role='form')-->
                    <!--                    input.form-control(type='text', placeholder='Search...')-->
                    <!--                    |-->
                    <!--                    button.search-btn(type='submit')-->
                    <!--                        i.fa.fa-search-->
                    <li class="dropdown"><a class="dropdown-toggle" href="documentation.html" data-toggle="dropdown">Documentation</a>
                        <ul class="dropdown-menu">
                            <li><a href="documentation.html#contact">Contact Form</a></li>
                            <li><a href="documentation.html#reservation">Reservation Form</a></li>
                            <li><a href="documentation.html#mailchimp">Mailchimp</a></li>
                            <li><a href="documentation.html#gmap">Google Map</a></li>
                            <li><a href="documentation.html#plugin">Plugins</a></li>
                            <li><a href="documentation.html#changelog">Changelog</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>--}}
    <section class="home-section home-parallax home-fade home-full-height bg-dark-60 agency-page-header" id="home"
             data-background="{{public_url('assets/images/agency/agency_bg.jpg')}}">
        <div class="titan-caption">
            <div class="caption-content">
                <div class="font-alt mb-30 titan-title-size-1">Grow your awesome idea</div>
                <div class="font-alt mb-40 titan-title-size-3">Make business <span class="rotate">easy | simple | flexible</span>
                </div>
                <a class="section-scroll btn btn-border-w btn-circle" href="#about">Learn More</a>
            </div>
        </div>
    </section>
    <div class="main">

        @yield('content')

        <section class="module" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h2 class="module-title font-alt">Contact us</h2>
                        <div class="module-subtitle font-serif"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <form id="contactForm" role="form" method="post" action="php/contact.php">
                            <div class="form-group">
                                <label class="sr-only" for="name">Name</label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="Your Name*"
                                       required="required" data-validation-required-message="Please enter your name."/>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="email">Email</label>
                                <input class="form-control" type="email" id="email" name="email"
                                       placeholder="Your Email*" required="required"
                                       data-validation-required-message="Please enter your email address."/>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="7" id="message" name="message"
                                          placeholder="Your Message*" required="required"
                                          data-validation-required-message="Please enter your message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-block btn-round btn-d" id="cfsubmit" type="submit">Submit
                                </button>
                            </div>
                        </form>
                        <div class="ajax-response font-alt" id="contactFormResponse"></div>
                    </div>
                    <div class="col-sm-4">
                        <div class="alt-features-item mt-0">
                            <div class="alt-features-icon"><span class="icon-megaphone"></span></div>
                            <h3 class="alt-features-title font-alt">Where to meet</h3>Titan Company<br/>23 Greate Street<br/>Los
                            Angeles, 12345 LS
                        </div>
                        <div class="alt-features-item mt-xs-60">
                            <div class="alt-features-icon"><span class="icon-map"></span></div>
                            <h3 class="alt-features-title font-alt">Say Hello</h3>Email: somecompany@example.com<br/>Phone:
                            +1 234 567 89 10
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="module-small bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="widget">
                            <h5 class="widget-title font-alt">About Titan</h5>
                            <p>The languages only differ in their grammar, their pronunciation and their most common
                                words.</p>
                            <p>Phone: +1 234 567 89 10</p>Fax: +1 234 567 89 10
                            <p>Email:<a href="#">somecompany@example.com</a></p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget">
                            <h5 class="widget-title font-alt">Recent Comments</h5>
                            <ul class="icon-list">
                                <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                                <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                                <li>Andy on <a href="#">Eco bag Mockup</a></li>
                                <li>Jack on <a href="#">Bottle Mockup</a></li>
                                <li>Mark on <a href="#">Our trip to the Alps</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget">
                            <h5 class="widget-title font-alt">Blog Categories</h5>
                            <ul class="icon-list">
                                <li><a href="#">Photography - 7</a></li>
                                <li><a href="#">Web Design - 3</a></li>
                                <li><a href="#">Illustration - 12</a></li>
                                <li><a href="#">Marketing - 1</a></li>
                                <li><a href="#">Wordpress - 16</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="widget">
                            <h5 class="widget-title font-alt">Popular Posts</h5>
                            <ul class="widget-posts">
                                <li class="clearfix">
                                    <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-1.jpg"
                                                                                     alt="Post Thumbnail"/></a></div>
                                    <div class="widget-posts-body">
                                        <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                                        <div class="widget-posts-meta">23 january</div>
                                    </div>
                                </li>
                                <li class="clearfix">
                                    <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-2.jpg"
                                                                                     alt="Post Thumbnail"/></a></div>
                                    <div class="widget-posts-body">
                                        <div class="widget-posts-title"><a href="#">Realistic Business Card Mockup</a>
                                        </div>
                                        <div class="widget-posts-meta">15 February</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="divider-d">
        <footer class="footer bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="copyright font-alt">&copy; 2017&nbsp;<a href="index.html">TitaN</a>, All Rights
                            Reserved</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i
                                        class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a
                                    href="#"><i class="fa fa-skype"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
</main>
<!--
JavaScripts
=============================================
-->
<!--<script src="{{public_url('assets/lib/jquery/dist/jquery.js')}}"></script>
<script src="{{public_url('assets/lib/bootstrap/dist/js/bootstrap.min.js')}}"></script>-->
<script src="{{public_url('js/app.js')}}"></script>
<script src="{{public_url('assets/lib/wow/dist/wow.js')}}"></script>
<script src="{{public_url('assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js')}}"></script>
<script src="{{public_url('assets/lib/isotope/dist/isotope.pkgd.js')}}"></script>
<script src="{{public_url('assets/lib/imagesloaded/imagesloaded.pkgd.js')}}"></script>
<script src="{{public_url('assets/lib/flexslider/jquery.flexslider.js')}}"></script>
<script src="{{public_url('assets/lib/owl.carousel/dist/owl.carousel.min.js')}}"></script>
<script src="{{public_url('assets/lib/smoothscroll.js')}}"></script>
<script src="{{public_url('assets/lib/magnific-popup/dist/jquery.magnific-popup.js')}}"></script>
<script src="{{public_url('assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js')}}"></script>
<script src="{{public_url('assets/js/plugins.js')}}"></script>
<script src="{{public_url('assets/js/main.js')}}"></script>

@yield('footer')
<?php wp_footer();?>
</body>
</html>