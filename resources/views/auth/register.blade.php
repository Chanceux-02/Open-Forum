@include('partials._header')

<div class="container">
    <div class="mt-5 pt-5 mx-auto  form-container">

        <h1 class="test">Register</h1>

        <p class="mt-3">Already have an account? log in <a href="{{ route('login-page') }}">here!</a> </p>

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


        <form action="/register" method="POST" class="mt-5">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" id="fname">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="lname">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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
