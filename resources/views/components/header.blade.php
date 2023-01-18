<header>
    <div class="container">
        <div class="row">
            <div class="col-2 col-md-1">
                <a href="{{ route('homepage') }}">
                    <img src="{{ asset('image/logo.png') }}" alt="" style="height: 60px">
                </a>
            </div>
            <div class="col-md-10 col-8 pt-2">
                <div class="box-search border border-secondary border-1 position-relative pe-5 ps-3">
                    <form action="{{ route('homepage') }}">
                        <input type="text" class="border-0 w-100" name="search" placeholder="Tìm kiếm..." value="{{ request()->search }}">
                        <button class="icon position-absolute btn btn-secondary text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-2 col-md-1 pt-2">
                <a href="{{ route('posts.create') }}" class="btn btn-primary rounded-pill"><i class="fas fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
</header>
