@php
    use Carbon\Carbon;
    Carbon::setLocale('vi');
    // extract($data);
    // $works = \App\Work::limit($items)->get();
@endphp

@empty(!$service)
    <section class="block2">
        <div class="container py-5">

            <h2 class="sec_h text-center mb-5">
                SERVICES WE DELIVER
            </h2>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 ">
                @foreach ($service as $item)
                    <div class="col block_img">
                        <i class="{{ $item->icon }} fa-2x mb-4"></i>
                        <h3>{{ $item->name }}</h3>
                        {!! htmlspecialchars_decode($item->description) !!}
                        <a href="{{ route('service.detail', ['slug' => $item->slug, 'id' => $item->id]) }}" class="read-more">@lang('Explore service')</a>
                    </div>
                @endforeach
                {{-- <div class="col block_img">
                    <i class="fa-light fa-megaphone fa-2x mb-4"></i>
                    <h3>MARKETING</h3>
                    <ul>
                        <li>LOGO & BRAND IDENTITY</li>
                        <li>PACKAGING SYSTEM</li>
                        <li>DESIGN</li>
                        <li>MARKETING STRATEGY</li>
                    </ul>
                    <a href="/notes" class="read-more">@lang('Explore service')</a>
                </div>

                <div class="col block_img">
                    <i class="fa-light fa-calendar-pen fa-2x mb-4"></i>
                    <h3>EVENT</h3>
                    <p></p>
                    <a href="/notes" class="read-more">@lang('Explore service')</a>
                </div> --}}
            </div>
        </div>
    </section>
@endempty
