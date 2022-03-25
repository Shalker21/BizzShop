<!-- Skippy -->
<a id="skippy" class="visually-hidden visually-hidden-focusable u-skippy" href="#content">
    <div class="container">
        <span class="u-skiplink-text">Skip to main content</span>
    </div>
</a>
<!-- End Skippy -->
<!-- Preload -->
<div id="loading" class="preloader">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<!-- End Preload -->

@include('site.partials.search_bar')

@include('site.partials.modals')

<!-- 
===================================
    Wrapper / this div ends in homepage.blade.php ! and his child -> div/div
===================================
-->
<div class="wrapper">
    <!-- Header -->
    <div class="header-height-bar"></div>
    <header class="header-main bg-white header-light fixed-top header-height header-option-1">
        
        @include('site.partials.nav_top')

        @include('site.partials.nav_bottom')

    </header>
    <!-- Header End -->