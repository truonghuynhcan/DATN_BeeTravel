<header class="bg-body container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <img src="{{ asset('') }}assets/image/logo_ngang.png" alt="" height="60px">

        <div class="d-flex">
            <button type="button" class="btn btn-outline-primary position-relative me-4 mt-2">
                <i class="bi bi-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    99+
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>
            <div class="dropdown">
                <button class="btn btn-secondary bg-secondary bg-opacity-75 rounded-circle p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('') }}assets/image/logo_BeeTravel.png" class="object-fit-cover" height="35px" width="35px" alt="">
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr>
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
