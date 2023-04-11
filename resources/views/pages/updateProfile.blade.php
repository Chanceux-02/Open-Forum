@include('partials._header')

<div class="container">
    <div class="mt-5 pt-5 mx-auto  form-container">

        <a class="btn btn-primary mb-3" href="{{route('user-profile')}}">Back</a>

        <h1 class="test">Update Your Profile</h1>

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


        <form action="{{'/update/profile'}}" method="POST" class="mt-5" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{$userData->first_name}}" id="fname">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{$userData->last_name}}" id="lname">
            </div>
            <div class="mb-3">
                <label for="profilepic1" class="form-label">Upload your profile pircture</label>
                <input type="file" name="profilePic" class="form-control" id="profilepic1">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{$userData->email}}" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmed" class="form-label">Confirm your password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmed">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>


@include('partials._footer')
