<header>
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-11 col-10">
                <div class="box-search border border-secondary border-1 position-relative pe-5 ps-3">
                    <form action="{{ route('homepage') }}">
                        <input type="text" class="border-0 w-100" name="search" placeholder="Tìm kiếm..." value="{{ request()->search }}">
                        <button class="icon position-absolute btn btn-secondary text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-2 col-md-1">
                <a href="{{ route('posts.create') }}" class="btn btn-primary rounded-pill"><i class="fas fa-plus-circle"></i></a>
            </div>
        </div>
    </div>
</header>
