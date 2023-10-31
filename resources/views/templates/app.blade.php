@include(('templates.head'))


{{--bootstrap, a col in the left side and the contend in the right--}}


<div class="d-flex">
@include(('templates.panel'))
<div class="col-md-9 col-lg-10 d-md-block bg-light ">
    @if(session()->has('success'))
        <div class="alert alert-success">

            {{ session()->get('success') }}

        </div>
    @endif
    <div class="container mt-5">
    @yield('content')
    </div>
</div>
</div>
@include(('templates.footer'))



