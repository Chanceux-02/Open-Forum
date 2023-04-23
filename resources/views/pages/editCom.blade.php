@include('partials._header')

<div class="container">
    <div class="mt-5 pt-5 mx-auto  form-container">

        <a class="btn btn-primary mb-3" href="{{route('user-profile')}}">Back</a>

        <h1 class="test">Edit Post</h1>

        @if ($errors->any())
        {{-- {{ dd($errors);}} --}}
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('update-com') }}" method="POST" enctype="multipart/form-data" class="mt-5">
            @method('PUT')
            @csrf

            <input type="hidden" name="id" value="{{$comData->comment_id}}">
            <input type="hidden" name="postId" value="{{request()->route('postId')}}">
            <div class="mb-3">
                <label for="comment" class="form-label" class="form-label">Edit comment</label>
                <input type="text" class="form-control" name="com" id="comment">
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>

    </div>
</div>


@include('partials._footer')
