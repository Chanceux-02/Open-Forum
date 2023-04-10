
    @include('partials._header')
    
    <div class="text-black-50 text-center bg-white p-5 contaier">
        <h1>{{'Mange your profile '.$user->first_name}}</h1>
    </div>


    <header class="container-fluid sticky-top p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-white p-3 px-5">
            <div class="container-fluid">
                <a class="navbar-brand px-0 mx-5" href="#"><i class="fa-brands fa-forumbee fa-lg"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item px-3">
                            <a class="nav-link" aria-current="page" href="{{ route('Home-page') }}">Home</a>
                        </li>
                        <li class="nav-item px-3">
                            <a class="nav-link" href="{{route('create-post')}}">Add Post</a>
                        </li>
                        <li class="nav-item dropdown px-3">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item active" href="#">Profile</a></li>
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

    <section class=" d-flex flex-column bg-white p-5 rounded shadow-sm">
        <div class="d-flex justify-content-end me-4">
            <a href="{{route('edit-profile')}}">
                <i class="fa-solid fa-pen-to-square fa-lg"></i>
            </a>
        </div>
        <section class="d-flex align-items-center profile">
            <div class="d-flex flex-column text-center profileContainer">
                <div class="px-1">
                    <img src="{{Storage::url('public/user/profile-pics/'. $user->profile_pic)}}" alt="User Profile Picture"  class="profile-image-size rounded-circle">
            </div>
            <div class="px-1 pt-4">
                    <h6>{{$user->first_name .' '. $user->last_name}}</h6>
            </div>
            </div>
            <div class="text-center bio">
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Corrupti provident esse quaerat, nihil, id quasi sit incidunt excepturi sequi accusantium cupiditate, ipsum asperiores rem magni exercitationem laboriosam. Harum, ducimus rem.</p>
            </div>
        </section>
       <hr>
    </section>

    <div class="container d-flex justify-content-center custom-padding mxwidth flex-column">
        <section class="container mt-2">
            @foreach($data as $datas)
           
                    <section class="mb-5 bg-white nf-padding rounded shadow-sm">
                        <div class="dropdown d-flex justify-content-end">
                            <a class="mb-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis fa-lg"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('edit-post', ['id' => $datas->post_id]) }}">Edit</a></li>
                                <li><a class="dropdown-item" href="{{ route('delete-post', ['id' => $datas->post_id]) }}">Delete</a></li>
                            </ul>
                        </div>
                        <div class="border-bottom d-flex flex-column">
                            <div class="d-flex ">
                                <div class="px-3 pb-3 justify-content-center align-items-center text-center d-none d-md-flex flex-column">
                                    <img src="{{ Storage::url('user/profile-pics/'.$user->profile_pic)}}" alt=":)" class="profile-image-size rounded-circle">
                                    <p class="pt-1 profile-name">{{$user->first_name .' '. $user->last_name}}</p>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="px-3">
                                        <div class="d-flex align-items-start flex-column pb-2" >
                                            <div  class="d-flex justify-content-center align-items-center d-block d-md-none pe-3 pb-2">
                                                <img src="{{ Storage::url('user/profile-pics/'.$user->profile_pic)}}" alt=":)" class="mobile-profile-image-size rounded-circle">
                                                <p class="pt-4 ps-2 profile-name">{{$user->first_name .' '. $user->last_name}}</p>
                                            </div>
                                                <h3><a href="http://" class="text-decoration-none">{{$datas->post_title}}</a></h3>
                                        </div>
                                            <p>{{$datas->post_content}}</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{ Storage::url('post/images/'.$datas->image_name)}}" alt=":)" class="post-image-size">
                            </div>

                            <div class="d-flex justify-content-end mt-5">
                                <p class="text-black-50 fw-light px-2 like-count2-{{$datas->post_id}}" id="like-count2-{{$datas->post_id}}"></p>
                                
                                @foreach($like as $likes)
                                    @if($likes->post_id == $datas->post_id)
                                        <p class="text-black-50 fw-light px-2 like-count-1" id="like-count-a{{$datas->post_id}}"> {{$likes->likes_count}} </p>
                                    @endif
                                @endforeach           
                                <form action="{{'/like/post'}}" method="POST" class="like-form me-3">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$datas->post_id}}">
                                    <button type="submit" class="prevent" style="background-color: transparent; border: none;">
                                        <i class="fa-solid fa-hand-holding-medical fa-lg helpful" id="helpful2a-{{$datas->post_id}}"></i>
                                    </button>
                                </form>     
                               {{-- sa comment na ni --}}
                                {{-- islan answers --}}
                                <p class="text-black-50 fw-light px-2"> 5 </p>
                                <a href="{{route('comment-post',['id' => $datas->post_id])}}" class="text-muted" style="text-decoration: none;">Answers</a>       
                                {{-- <button type="submit" class="text-muted" style="background-color: transparent; border: none;">Answers</button>   --}}
                            </div>
                        </div>
                    </section>
            @endforeach
        </section>
    </div>

    <script>
        let likedd = {!! json_encode($liked) !!};
        likedd.forEach(function(item) {
            let postid = item.liked_id;
            let testing = '#helpful2a-' + postid;
            $(testing).removeClass('helpful');
            $(testing).addClass('helpful2');
        });
    </script>

    @include('partials._footer')
