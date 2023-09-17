    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="copyright text-center">
            <div class="text-center mb-3 mb-md-0">
                &copy; <a class="border-bottom" href="{{route('website.index')}}">{{getWebsiteInfo()->website_name}}</a>, All Right Reserved.
            </div>
            <div class="d-flex pt-2" style="justify-content: center">
                @if(getWebsiteInfo()->facebook)
                <a class="btn btn-outline-light btn-social" href="{{getWebsiteInfo()->facebook}}"><i class="fab fa-facebook-f"></i></a>
                @endif
                @if(getWebsiteInfo()->twitter)
                <a class="btn btn-outline-light btn-social" href="{{getWebsiteInfo()->twitter}}"><i class="fab fa-twitter"></i></a>
                @endif
                @if(getWebsiteInfo()->instagram)
                <a class="btn btn-outline-light btn-social" href="{{getWebsiteInfo()->instagram}}"><i class="fab fa-instagram"></i></a>
                @endif
                @if(getWebsiteInfo()->youtube)
                <a class="btn btn-outline-light btn-social" href="{{getWebsiteInfo()->youtube}}"><i class="fab fa-youtube"></i></a>
                @endif
                @if(getWebsiteInfo()->linkedin)
                <a class="btn btn-outline-light btn-social" href="{{getWebsiteInfo()->linkedin}}"><i class="fab fa-linkedin-in"></i></a>
                @endif
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>