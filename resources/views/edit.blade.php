@extends("layout._lay")
@section("content")
    @include("layout._nav")
    <section class="mt-5">
        <div class="container">
            <form method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="mb-2">Blog Başlığı</label>
                            <input type="text" name="name" class="form-control" value="{{ $blog->name }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="mb-2">İlgili Departmanlar</label>
                            <select name="departments[]" multiple class="form-control">
                                @foreach($departments as $department)
                                    <option value="{{ $department["id"] }}" {{ in_array($department["id"], json_decode($blog->department_ids)) ? "selected" : "" }}>{{ $department["name"] }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="mb-2">Blog İçeriği</label>
                            <textarea name="content" class="form-control" cols="30" rows="10">{{ $blog->content }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Onaya Gönder</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
