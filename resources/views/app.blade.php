@extends("layout._lay")
@section("content")
    @include("layout._nav")
    <section class="mt-5">
        <div class="container">
            @foreach($blogs as $blog)
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->name }}</h5>
                            <p class="card-text">{{ $blog->content }}</p>

                            @if(in_array('add_blogs', Arr::pluck($user['role']['permissions'], 'name')))
                                <a href="{{ route("app.edit", $blog->id) }}" class="card-link">Düzenle</a>
                            @endif
                            @if(in_array('delete_blogs', Arr::pluck($user['role']['permissions'], 'name')))
                                <a href="{{ route("app.delete", $blog->id) }}" class="card-link">Sil</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
