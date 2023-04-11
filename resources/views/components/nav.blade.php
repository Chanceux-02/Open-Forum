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
                        <li><a class="dropdown-item" href="{{route('user-profile')}}">Profile</a></li>
                        {{-- <li><a class="dropdown-item" href="#">Another action</a></li> --}}
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