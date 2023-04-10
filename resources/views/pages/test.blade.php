@include('partials._header')

<div class="container">
    <div class="mt-5 pt-5 mx-auto  form-container">

        <a class="btn btn-primary mb-3" href="{{route('Home-page')}}">Back</a>

        <h1 class="test">Create Post</h1>

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


        <form action="{{ url ('/upload/post') }}" method="POST" enctype="multipart/form-data" class="mt-5">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="textarea" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="textarea" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Upload your snippets here!</label>
                <input type="file" name="image" class="form-control" id="file">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>


@include('partials._footer')
