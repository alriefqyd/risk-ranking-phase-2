
@include('components.asset')
<!-- Loader starts-->
<div class="loader-wrapper">
    <div class="theme-loader">
        <div class="loader-p"></div>
    </div>
</div>
<!-- Loader ends-->
<!-- error page start //-->
<div class="page-wrapper" id="pageWrapper">
    <div class="error-wrapper">
        <div class="container">
            <div class="error-page1">
                <div class="col-md-8 offset-md-2">
                    <h3>500 - Internal server error</h3>
                    <p class="sub-content">The page you are attempting to reach is currently not available. This may be because the page does not exist or has been moved.</p><a class="btn btn-primary btn-lg" href="/">BACK TO HOME PAGE</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.js')
<!-- error page end //-->
