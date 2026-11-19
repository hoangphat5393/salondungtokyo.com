@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    // extract($data);
    // $works = \App\Work::limit($items)->get();
@endphp

@empty(!$work)
    <section class="block3">

        <div class="container py-5">

            <div class="row justify-content-center">

                <div class="row justify-content-center py-4">
                    <div class="col-lg-12">
                        <h2 class="sec_h">Works<sup>{{ $work->count() }}</sup></h2>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-3 g-lg-4 mb-3 mb-lg-4">
                    @foreach ($work as $item)
                        <div class="col block_img">
                            <figure class="img-res">
                                <img src="{{ $item->image }}" class="img-fluid" alt="{{ setting_option('webtitle') }}">
                            </figure>
                            <p>
                                Loiloi<br>
                                <span>Graphic Design</span>
                            </p>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('work') }}" class="btn btn-custom">More Works</a>
            </div>


        </div>

    </section>
@endempty
