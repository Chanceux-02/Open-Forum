@include('partials._header');

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <h1 class="text-black-50 text-center mt-5">Open Forum</h1>

    <x-nav/>

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

    @include('partials._footer');
