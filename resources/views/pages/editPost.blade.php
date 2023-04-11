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


        <form action="{{ route('update-post', ['id' => $postData->post_id]) }}" method="POST" enctype="multipart/form-data" class="mt-5">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$postData->post_title}}">
            </div>
            <div class="mb-3">
                <label for="textarea" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="textarea" rows="3" value="{{$postData->post_content}}">{{$postData->post_content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Upload your snippets here!</label>
                <input type="file" name="image" class="form-control" id="file" value="{{$postData->image_name}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>


@include('partials._footer')
