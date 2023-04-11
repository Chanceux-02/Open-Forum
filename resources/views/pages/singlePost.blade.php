@include('partials._header')

<div class="container d-flex justify-content-center flex-column custom-padding mxwidth">
    <section class="container">
        @foreach($info as $datas)
        <a class="btn btn-primary mb-3" href="{{route('Home-page')}}">Back</a>
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
                        <p class="text-black-50 fw-light px-2"> 5 </p>
                        <a href="{{route('comment-post',['id' => $datas->post_id])}}" class="text-muted" style="text-decoration: none;">Answers</a>       
                        {{-- <button type="submit" class="text-muted" style="background-color: transparent; border: none;">Answers</button>   --}}
                    </div>
                </section>
        @endforeach
        {{-- sa comment --}}
        <section class="bg-white rounded comment-padding shadow-sm">
            <p>Comments</p>
            <hr>
            <div class="px-3 pb-3 d-flex flex-column sigle-post-mobile">
                @foreach ($comment as $comments)
                    <div class="d-flex">
                        <img src="{{ Storage::url('user/profile-pics/'.$comments->profile_pic)}}" alt=":)" class="profile-image-size rounded-circle me-3">
                        <p>{{$comments->content}}</p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <p class="text-black-50 fw-light px-2 vote-count2-{{$comments->comment_id}}" id="vote-count2-{{$comments->comment_id}}">{{$voted}}</p>

                            @if($comments->comment_id == $comments->comment_id)
                                <p class="text-black-50 fw-light px-2 vote-count-1" id="vote-count-a{{$comments->comment_id}}"> </p>
                            @endif

                        <form action="{{ route('like-comment') }}" method="POST" class="vote-form me-3">
                            @csrf
                            <input type="hidden" name="postId" value="{{$datas->post_id}}">
                            <input type="hidden" name="comId" value="{{$comments->comment_id}}">
                            <button type="submit" class="voteBtn" style="background-color: transparent; border: none;">
                                <i class="fa-solid fa-circle-arrow-up fa-lg helpful" id="vote2a-{{$comments->comment_id}}"></i>
                            </button>
                        </form>
                    </div>
                    <hr>
                @endforeach
                <section class="mt-3">
                    <form action="{{ route('answer-post', ['id'=> $datas->post_id]) }}" method="POST" class="me-3 d-flex">
                        @csrf
                        <input type="text" name="comment" placeholder="comment" class="form-control">
                        <button type="submit" id="" style="background-color: transparent; border: none;" class="ms-3">
                            <i class="fa-solid fa-paper-plane fa-xl" style="color: #505358;"></i>
                        </button>
                    </form>
                </section>
            </div>
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

    // let voted = {!! json_encode($voted) !!};
    // voted.forEach(function(item) {
    //     let voteId = item.voted_id;
    //     let clss = '#helpful2a-' + voteId;
    //     $(clss).removeClass('helpful');
    //     $(clss).addClass('helpful2');
    // });

     
</script>
@include('partials._footer')

