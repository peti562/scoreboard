
@include('layouts.header')
@include('layouts.nav')

<div id="wrapper">


    @include('layouts.sidebar')

    <div id="content-wrapper">

        <div class="container-fluid">

            @include('inc.breadcrumbs')

            {{--@include('dashboard.icon-cards')--}}

            {{--@include('dashboard.area-chart')--}}

            @yield('content')

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Peter Makadi 2018</span>
                </div>
            </div>
        </footer>

    </div>
</div>




@include('layouts.footer')
