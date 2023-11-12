@extends("layout._lay")
@section("content")
    <section class="position-relative d-flex flex-column align-items-center justify-content-center py-8" style="width: 100vw;height: 100vh;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 py-lg-20">
                    <div class="mw-md mx-auto px-5">
                        <form action="" method="post">
                            @csrf
                            <div class="mb-6 mb-3">
                                <label class="form-label" for="exampleForm1">Email Address</label>
                                <input class="form-control" name="email" id="exampleForm1" type="email" placeholder="">
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="exampleForm2">Password</label>
                                <input class="form-control" name="password" id="exampleForm2" type="password" placeholder="">
                            </div>
                            <button class="btn btn-primary py-3 mt-4 mb-4 w-100">Giriş Yap</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-none d-lg-block position-absolute d-flex flex-column align-items-center justify-content-center top-0 bottom-0 end-0 col-6 bg-dark">
            <img class="img-fluid" style="width: 100%; height: 100%; object-fit: cover; object-position: bottom;" src="https://picsum.photos/1920/1080" alt="">
        </div>
    </section>
@endsection
