@inject('ServiceSetup', 'App\Models\ServiceSetup')
@php
    // $custom_fields = $custom_field ?? '';
    // if ($custom_fields && $custom_fields != '""') {
    //     $custom_fields = json_decode($custom_fields, true);
    //     end($custom_fields); // move the internal pointer to the end of the array
    //     $key_index = key($custom_fields);
    // }

    $custom_fields = $ServiceSetup::select('name', 'description')->where('service_id', $id)->get();

    if ($custom_fields != '') {
        $custom_fields = json_decode($custom_fields, true);
        end($custom_fields); // move the internal pointer to the end of the array
        $key_index = key($custom_fields);
    }
@endphp

<div class="custom_field">

    {{-- Tab pill --}}
    {{-- <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="en-tab" data-toggle="pill" data-target="#pills-custom-field-en" type="button" role="tab" aria-controls="pills-home" aria-selected="true">English</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="vi-tab" data-toggle="pill" data-target="#pills-custom-field-vi" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Vietnamese</button>
        </li>
    </ul> --}}

    {{-- Tab content --}}
    <div class="tab-content" id="pills-tabContent">

        {{-- VN --}}
        <div class="tab-pane fade show active" id="pills-custom-field-vi" local="" role="tabpanel" aria-labelledby="vi-tab">
            <div class="d-flex mb-2">
                <div class="col-5 border-bottom pb-1">Tiêu đề</div>
                <div class="col-5 border-bottom pb-1">Nội dung</div>
                <div class="col-2 border-bottom pb-1"></div>
            </div>
            <div class="spec-short-clone" data="{{ $key_index ?? 0 }}" style="display: none;">
                <div class="form-group row group-item">
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <input type="text" class="form-control spec-short-name" name="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        {{-- <input type="text" class="form-control spec-short-desc" name=""> --}}
                        <textarea name="" id="" cols="30" rows="10" class="form-control spec-short-desc"></textarea>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-danger w-100 text-center spec-remove">Xóa</button>
                    </div>
                </div>
            </div>
            <div class="spec-short-group">
                @if ($custom_fields != '' && is_array($custom_fields))
                    @foreach ($custom_fields as $index => $item)
                        <div class="form-group row group-item">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <input type="text" class="form-control spec-short-name" name="custom_field[{{ $index }}][name]" value="{{ $item['name'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                {{-- <input type="text" class="form-control spec-short-desc" name="custom_field[{{ $index }}][description]" value="{!! $item['description'] ?? '' !!}"> --}}
                                <textarea name="custom_field[{{ $index }}][description]" id="description{{ $loop->index }}" cols="30" rows="10" class="form-control spec-short-desc editor">
                                    {!! $item['description'] ?? '' !!}
                                </textarea>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-danger w-100 text-center spec-remove">Xóa</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="spec-btn text-right">
                <button type="button" class="btn btn-primary custom_field-add">Thêm trường</button>
            </div>
        </div>

    </div>
</div>


@push('scripts')
    <script>
        $(function() {

            var custom_field = $('.custom_field');
            if (custom_field.length > 0) {
                $(document).on('click', '.custom_field .ckfinder-popup', function() {
                    var id = $(this).attr('id'),
                        input = $(this).attr('data'),
                        view_img = $(this).data('show');
                    selectFileWithCKFinder(input, view_img);
                })
                $('.custom_field-add').click(function() {
                    var ele = $(this).parents('.tab-pane');
                    var local = ele.attr('local') ? '_' + ele.attr('local') : '';
                    var id = ele.find('.spec-short-clone').attr('data');
                    // console.log(id);

                    id = parseInt(id) + 1;
                    ele.find('.spec-short-clone').attr('data', id);
                    // console.log(id);

                    var html = ele.find('.spec-short-clone').find('.group-item').clone();
                    html.find('input.spec-short-name').attr('name', 'custom_field' + local + '[' + id + '][name]');
                    html.find('textarea.spec-short-desc').attr('name', 'custom_field' + local + '[' + id + '][description]');
                    html.find('textarea.spec-short-desc').attr('id', 'description' + id + local);
                    ele.find('.spec-short-group').append(html);

                    editorQuote('description' + id + local);
                });

                $(document).on('click', '.custom_field .spec-remove', function() {
                    $(this).closest('.form-group').remove();
                });


            }
        });

        // assumes ckeditor and jQuery are already loaded
        $(function() {
            $('.editor').each(function(e) {
                CKEDITOR.replace(this.id, {
                    toolbar: [
                        ["Source", "Bold", "Italic", "-", "NumberedList", "BulletedList", "-", "Link", "Unlink", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock"],
                        ["FontSize", "TextColor", "BGColor"],
                        ["Image"],
                        ["btgrid"],
                        ["txtEmbed", "chkAutoplay"],
                    ],
                    filebrowserBrowseUrl: "/ckfinder/browser",
                    height: "200px",
                });
            });
        });
    </script>
@endpush
