@include('partials._header')

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <h1 class="text-black-50 text-center mt-5">Open Forum</h1>

    <header class="container-fluid mt-5 sticky-top p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 px-5">
            <div class="container-fluid">
                <a class="navbar-brand px-0 mx-5" href="#"><i class="fa-brands fa-forumbee fa-lg"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item px-3">
                            <a class="nav-link active" aria-current="page" href="{{ route('Home-page') }}">Home</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="{{route('create-post')}}">Add Post</a>
                        </li>
                        <li class="nav-item dropdown px-3">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex me-5">
                    <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="container d-flex justify-content-center flex-column mxwidth">

        <section class="container mt-5">
            @foreach($data as $datas)
                {{-- @foreach($user as $users) --}}
                {{-- <li>{{ $user->name }}</li> --}}
                    <section class="border-bottom mt-5 d-flex flex-column">
                        <div class="d-flex ">
                            <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex  flex-column">
                                <img src="{{ Storage::url('user/profile-pics/'.$datas->profile_pic)}}" alt=":)" class="profile-image-size rounded-circle">
                                <p class="pt-1">{{$datas->first_name .' '. $datas->last_name}}</p>
                            </div>
                            <div class="d-flex flex-column">
                                <div>
                                    <div class="d-flex align-items-center" >
                                        <div  class="d-flex justify-content-center align-items-center text-center d-block d-md-none pe-3 flex-column">
                                            <img src="{{ Storage::url('user/profile-pics/'.$datas->profile_pic)}}" alt=":)" class="mobile-profile-image-size rounded-circle">
                                            <p class="pt-1">{{$datas->first_name .' '. $datas->last_name}}</p>
                                        </div>
                                        <h1><a href="http://" class="text-decoration-none">{{$datas->post_title}}</a></h1>
                                    </div>
                                    <p>{{$datas->post_content}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center align-items-center">
                            <img src="{{ Storage::url('post/images/'.$datas->image_name)}}" alt=":)" class="post-image-size">
                        </div>

                        <div class="d-flex justify-content-end py-2">
                            <p class="text-black-50 fw-light px-2">3k likes</p>
                            <p class="text-warning px-2">Like</p>
                            <p class="text-warning px-2">Comment</p>
                        </div>
                    </section>
                {{-- @endforeach --}}
            @endforeach

            <section class="border-bottom mt-5 d-flex flex-column">
                <div class="d-flex ">
                    <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex">
                        <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="profile-image-size">

                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            <h4 class="d-flex">
                                <div  class="d-flex justify-content-center align-items-center text-center d-block d-md-none pe-3">
                                    <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="mobile-profile-image-size">

                                </div>
                                <a href="http://" class="text-decoration-none">This is some heading</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor magni praesentium similique officia quibusdam excepturi quo minima esse, quisquam in at expedita quasi. Enim cumque quas at, tempora illo obcaecati.</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end py-2">
                    <p class="text-black-50 fw-light px-2">3k likes</p>
                    <p class="text-warning px-2">Like</p>
                    <p class="text-warning px-2">Comment</p>
                </div>
            </section>

            <section class="border-bottom mt-5 d-flex flex-column">
                <div class="d-flex ">
                    <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex">
                        <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="profile-image-size">

                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            <h4 class="d-flex">
                                <div  class="d-flex justify-content-center align-items-center text-center d-block d-md-none pe-3">
                                    <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="mobile-profile-image-size">

                                </div>
                                <a href="http://" class="text-decoration-none">This is some heading</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor magni praesentium similique officia quibusdam excepturi quo minima esse, quisquam in at expedita quasi. Enim cumque quas at, tempora illo obcaecati.</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end py-2">
                    <p class="text-black-50 fw-light px-2">3k likes</p>
                    <p class="text-warning px-2">Like</p>
                    <p class="text-warning px-2">Comment</p>
                </div>
            </section>

            <section class="border-bottom mt-5 d-flex flex-column">
                <div class="d-flex ">
                    <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex">
                        <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="profile-image-size">

                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            <h4 class="d-flex">
                                <div  class="d-flex justify-content-center align-items-center text-center d-block d-md-none pe-3">
                                    <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="mobile-profile-image-size">

                                </div>
                                <a href="http://" class="text-decoration-none">This is some heading</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor magni praesentium similique officia quibusdam excepturi quo minima esse, quisquam in at expedita quasi. Enim cumque quas at, tempora illo obcaecati.</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end py-2">
                    <p class="text-black-50 fw-light px-2">3k likes</p>
                    <p class="text-warning px-2">Like</p>
                    <p class="text-warning px-2">Comment</p>
                </div>
            </section>

            <section class="border-bottom mt-5 d-flex flex-column">
                <div class="d-flex ">
                    <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex">
                        <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="profile-image-size">

                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            <h4 class="d-flex">
                                <div  class="d-flex justify-content-center align-items-center text-center d-block d-md-none pe-3">
                                    <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="mobile-profile-image-size">

                                </div>
                                <a href="http://" class="text-decoration-none">This is some heading</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor magni praesentium similique officia quibusdam excepturi quo minima esse, quisquam in at expedita quasi. Enim cumque quas at, tempora illo obcaecati.</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end py-2">
                    <p class="text-black-50 fw-light px-2">3k likes</p>
                    <p class="text-warning px-2">Like</p>
                    <p class="text-warning px-2">Comment</p>
                </div>
            </section>

            <section class="border-bottom mt-5 d-flex flex-column">
                <div class="d-flex ">
                    <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex">
                        <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="profile-image-size">

                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            <h4 class="d-flex">
                                <div  class="d-flex justify-content-center align-items-center text-center d-block d-md-none pe-3">
                                    <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="mobile-profile-image-size">

                                </div>
                                <a href="http://" class="text-decoration-none">This is some heading</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor magni praesentium similique officia quibusdam excepturi quo minima esse, quisquam in at expedita quasi. Enim cumque quas at, tempora illo obcaecati.</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end py-2">
                    <p class="text-black-50 fw-light px-2">3k likes</p>
                    <p class="text-warning px-2">Like</p>
                    <p class="text-warning px-2">Comment</p>
                </div>
            </section>

            <section class="border-bottom mt-5 d-flex flex-column">
                <div class="d-flex ">
                    <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex">
                        <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="profile-image-size">

                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            <h4 class="d-flex">
                                <div  class="d-flex justify-content-center align-items-center text-center d-block d-md-none pe-3">
                                    <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="mobile-profile-image-size">

                                </div>
                                <a href="http://" class="text-decoration-none">This is some heading</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor magni praesentium similique officia quibusdam excepturi quo minima esse, quisquam in at expedita quasi. Enim cumque quas at, tempora illo obcaecati.</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end py-2">
                    <p class="text-black-50 fw-light px-2">3k likes</p>
                    <p class="text-warning px-2">Like</p>
                    <p class="text-warning px-2">Comment</p>
                </div>
            </section>

            <section class="border-bottom mt-5 d-flex flex-column">
                <div class="d-flex ">
                    <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex">
                        <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="profile-image-size">

                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            <h4 class="d-flex">
                                <div  class="d-flex justify-content-center align-items-center text-center d-block d-md-none pe-3">
                                    <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="mobile-profile-image-size">

                                </div>
                                <a href="http://" class="text-decoration-none">This is some heading</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor magni praesentium similique officia quibusdam excepturi quo minima esse, quisquam in at expedita quasi. Enim cumque quas at, tempora illo obcaecati.</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end py-2">
                    <p class="text-black-50 fw-light px-2">3k likes</p>
                    <p class="text-warning px-2">Like</p>
                    <p class="text-warning px-2">Comment</p>
                </div>
            </section>

            <section class="border-bottom mt-5 d-flex flex-column">
                <div class="d-flex ">
                    <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex">
                        <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="profile-image-size">

                    </div>
                    <div class="d-flex flex-column">
                        <div>
                            <h4 class="d-flex">
                                <div  class="d-flex justify-content-center align-items-center text-center d-block d-md-none pe-3">
                                    <img src="{{ asset('img/user/profile-default.png') }}" alt=":)" class="mobile-profile-image-size">

                                </div>
                                <a href="http://" class="text-decoration-none">This is some heading</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor magni praesentium similique officia quibusdam excepturi quo minima esse, quisquam in at expedita quasi. Enim cumque quas at, tempora illo obcaecati.</p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end py-2">
                    <p class="text-black-50 fw-light px-2">3k likes</p>
                    <p class="text-warning px-2">Like</p>
                    <p class="text-warning px-2">Comment</p>
                </div>
            </section>

        </section>

    </div>

    @include('partials._footer')
