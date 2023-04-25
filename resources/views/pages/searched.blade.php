@include('partials._header')

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="text-black-50 text-center bg-white p-5 contaier">
        <h1>Open Forum</h1>
    </div>

    <x-nav/>

    <div class="container d-flex justify-content-center flex-column custom-padding mxwidth">

        <section class="container">
            @foreach($info as $datas)

                    <section class="border-bottom mt-2 d-flex flex-column bg-white rounded nf-padding shadow-sm">
                        <div class="d-flex ">
                            <div class="px-3 pb-3  justify-content-center align-items-center text-center d-none d-md-flex  flex-column">
                                <img src="{{ Storage::url('user/profile-pics/'.$datas->profile_pic)}}" alt=":)" class="profile-image-size rounded-circle">
                                <p class="pt-1 profile-name">{{$datas->first_name .' '. $datas->last_name}}</p>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="px-3">
                                    <div class="d-flex align-items-start flex-column pb-2" >
                                        <div  class="d-flex justify-content-center align-items-center d-block d-md-none pe-3 pb-2">
                                            <img src="{{ Storage::url('user/profile-pics/'.$datas->profile_pic)}}" alt=":)" class="mobile-profile-image-size rounded-circle">
                                            <p class="pt-1 ps-2 profile-name">{{$datas->first_name .' '. $datas->last_name}}</p>
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
                            @foreach ($answers as $answer)
                                @if($answer->post_id == $datas->post_id)
                                  <p class="text-black-50 fw-light px-2"> {{$answer->comment_count}} </p>
                                @endif
                            @endforeach
                            <a href="{{route('comment-post',['id' => $datas->post_id])}}" class="text-muted" style="text-decoration: none;">Answers</a>       
                            {{-- <button type="submit" class="text-muted" style="background-color: transparent; border: none;">Answers</button>   --}}
                        </div>
                    </section>
            @endforeach
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
