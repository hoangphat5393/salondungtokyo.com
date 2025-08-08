@extends('backend.layouts.app')
@section('seo')
    @php
        $data_seo = [
            'title' => 'Setting cost | ' . Helpers::get_option_minhnn('seo-title-add'),
        ];
        $seo = WebService::getSEO($data_seo);
    @endphp
    @include('backend.partials.seo')
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Setting</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ $url_action }}" method="POST" id="frm-theme-option" enctype="multipart/form-data">
                                @csrf
                                <div class="container_group_setting clear">
                                    <div class="group_item_auto_theme clear">
                                        <div class="group_item_theme_sort" id="group_item_theme_sort">
                                            @if ($settings->count())
                                                @foreach ($settings as $index => $setting)
                                                    @if ($setting->type == 'line')
                                                        <div class="group_item_theme d-flex">
                                                            <div class="icon_change_postion"><i class="fa fa-sort"></i></div>
                                                            <div class="left_item_theme left_genate">
                                                                <input type="text" value="{{ $setting->name }}" placeholder="Please enter Name Field" name="header_option[line][name][]" />
                                                            </div>
                                                            <div class="right_item_theme right_genate d-flex">
                                                                <input type="text" class="regular-text" placeholder="Please enter Value Field" name="header_option[line][value][]" value="{{ $setting->content }}" />
                                                                <input type="text" class="regular-text" placeholder="Please enter Value Field" name="header_option[line][title][]" value="{{ $setting->title }}" />
                                                                <input type="button" class="button button-secondary tbl_button_delete_clean" value="Delete" name="delete_tbl">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <!--group_item_auto_theme-->
                                    <div class="tbl_create_theme_add d-flex justify-content-center align-items-center">
                                        <div class=" text-right">Chọn loại: </div>
                                        <div class="mx-3" style="min-width: 150px">
                                            <select name="option_choise_add" class="select_option_choise form-control">
                                                <option value="line">line</option>
                                            </select>
                                        </div>
                                        <button id="create_option" type="button" class="btn btn-primary create_option_class">Thêm trường dữ liệu</button>
                                    </div>
                                    <!--group_item_theme-->
                                </div>
                                <!--container_group_setting-->
                                <div class="posts_tbl_setting clear text-center">
                                    <button id="submit_setting" class="btn btn-primary pull-left mb-3" name="submit" type="submit">Lưu thay đổi</button>
                                    <p><b>Use:</b> <i style="color: #FF0000;">setting_cost('name');</i></p>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <div class="inlcude-image" style="display: none;">
        @include('admin.partials.image-inline')
    </div>



    <style type="text/css">
        .icon_change_postion {
            text-align: center;
            padding-top: 10px;
        }

        .container_group_setting {
            background: #f8f8f8 none repeat scroll 0 0;
            padding: 20px 10px;
            margin: 0 -10px;
        }

        .posts_tbl_setting {
            margin: 0px -10px 0 -10px;
            padding-top: 20px;
            border-top: 1px solid #e1e1e1;
            padding-left: 10px;
        }

        .posts_tbl_setting #submit_setting {}

        #page_title h3 {
            display: block;
            font-size: 25px;
            line-height: 30px;
            margin: 10px 0 0;
        }

        #post_body_content .content_setting {
            display: block;
            background: #FFF none repeat scroll 0 0;
            border-radius: 4px;
            margin-bottom: 20px;
            padding: 10px 10px 20px;
        }

        .tbl_create_theme_add {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
            line-height: 27px;
            margin: 10px 0px;
            padding: 10px 30px;
            border-radius: 3px;
        }

        .tbl_create_theme_add {
            color: #3c763d;
            line-height: 27px;
        }

        .right_item_theme {
            display: block;
            float: left;
            width: 78%;
            padding: 0 5px;
        }

        .left_item_theme {
            display: block;
            float: left;
            width: 22%;
            line-height: 29px;
        }

        .right_item_theme select.select_option_choise {
            height: 28px;
            line-height: 28px;
            padding: 2px 0;
            width: 150px;
            margin-right: 20px;
        }

        .right_item_theme select.select_option_choise option {
            height: 25px;
            line-height: 25px;
            display: block;
            color: #F30;
            margin-top: 3px;
        }

        .create_option_class,
        .tbl_choise_img_set {
            background-color: #0275d8 !important;
            border-color: #0275d8 !important;
            border-radius: 3px;
            border-style: solid;
            border-width: 1px;
            box-sizing: border-box;
            cursor: pointer;
            display: inline-block;
            font-size: 13px;
            height: 28px;
            /*   line-height: 26px;*/
            margin: 0 5px !important;
            text-align: center;
            color: #fff !important;
            padding: 0 10px 1px;
            text-decoration: none;
            white-space: nowrap;
        }

        .group_item_theme h3.line {
            border-bottom: 1px solid #e1e1e1;
            color: #900;
            font-size: 18px;
            font-weight: 600;
            margin: 0 -10px 0px;
            padding: 20px 30px;
        }

        #create_option {
            line-height: 15px;
        }

        .left_genate {
            width: 30%;
        }

        .left_genate input {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .right_genate {
            width: 68%;
        }

        .right_genate input.regular-text {
            width: 80%;
            margin-left: 5px;
            margin-right: 5px;
            border-radius: 3px;
            display: block;
            float: left;
            border: 1px solid #ccc;
        }

        .right_genate textarea.regular-area {
            width: 80%;
            border-radius: 3px;
            display: block;
            float: left;
            border: 1px solid #ccc;
            padding: 10px;
        }

        input.tbl_button_delete_clean {
            background-color: #d9534f !important;
            border-color: #d9534f !important;
            color: #fff !important;
            cursor: pointer;
            display: inline-block;
            /*   font-size: 13px;*/
            font-weight: 400;
            /*   line-height: 1.5;*/
            margin: 0 0 0 5px !important;
            /*   padding: 0.375rem 1rem;*/
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
            border: none;
            border-radius: 3px;
        }

        .group_item_auto_theme .group_item_theme {
            display: flex;
            margin-bottom: 10px;
        }

        #confirmOverlay {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background: url('../img/ie.png');
            background: -moz-linear-gradient(rgba(11, 11, 11, 0.1), rgba(11, 11, 11, 0.6)) repeat-x rgba(11, 11, 11, 0.2);
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgba(11, 11, 11, 0.1)), to(rgba(11, 11, 11, 0.6))) repeat-x rgba(11, 11, 11, 0.2);
            z-index: 100000;
        }

        #confirmBox {
            background: url('../img/body_bg.jpg') repeat-x left bottom #e5e5e5;
            width: 460px;
            position: fixed;
            left: 50%;
            top: 50%;
            margin: -130px 0 0 -230px;
            border: 1px solid rgba(33, 33, 33, 0.6);
            -moz-box-shadow: 0 0 2px rgba(255, 255, 255, 0.6) inset;
            -webkit-box-shadow: 0 0 2px rgba(255, 255, 255, 0.6) inset;
            box-shadow: 0 0 2px rgba(255, 255, 255, 0.6) inset;
        }

        #confirmBox h1,
        #confirmBox p {
            font: 26px/1 'Cuprum', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;
            background: url('../img/header_bg.jpg') repeat-x left bottom #f5f5f5;
            padding: 18px 25px;
            text-shadow: 1px 1px 0 rgba(255, 255, 255, 0.6);
            color: #666;
        }

        #confirmBox h1 {
            letter-spacing: 0.3px;
            color: #888;
        }

        #confirmBox p {
            background: none;
            font-size: 16px;
            line-height: 1.4;
            padding-top: 35px;
        }

        #confirmButtons {
            padding: 15px 0 25px;
            text-align: center;
        }

        #confirmBox .button {
            display: inline-block;
            background: url('../img/buttons.png') no-repeat;
            color: white;
            position: relative;
            height: 33px;
            border-radius: 0px;
            font: 17px/33px 'Cuprum', 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;
            margin-right: 15px;
            padding: 0 35px 0 40px;
            text-decoration: none;
            border: none;
        }

        #confirmBox .button:last-child {
            margin-right: 0;
        }

        #confirmBox .button span {
            position: absolute;
            top: 0;
            right: -5px;
            background: url('../img/buttons.png') no-repeat;
            width: 5px;
            height: 33px
        }

        #confirmBox .blue {
            background-position: left top;
            text-shadow: 1px 1px 0 #5889a2;
        }

        #confirmBox .blue span {
            background-position: -195px 0;
        }

        #confirmBox .blue:hover {
            background-position: left bottom;
        }

        #confirmBox .blue:hover span {
            background-position: -195px bottom;
        }

        #confirmBox .gray {
            background-position: -200px top;
            text-shadow: 1px 1px 0 #707070;
        }

        #confirmBox .gray span {
            background-position: -395px 0;
        }

        #confirmBox .gray:hover {
            background-position: -200px bottom;
        }

        #confirmBox .gray:hover span {
            background-position: -395px bottom;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {

            $(document).on("click", "#create_option", function(event) {
                // event.preventDefault();

                var choise_option = $('select[name="option_choise_add"]').val();
                var line_html = '<div class="group_item_theme">' +
                    '<div class="icon_change_postion"><i class="fa fa-sort"></i></div>' +
                    '<div class="left_item_theme left_genate"><input type="text" value="" placeholder="Please enter Name Field"  name="header_option[line][name][]" /></div>' +
                    '<div class="right_item_theme right_genate d-flex"><input type="text" class="regular-text" placeholder="Please enter Value Field" name="header_option[line][value][]" value="" /><input type="text" class="regular-text" placeholder="Please enter Value Field" name="header_option[line][title][]" value="" /><input type="button" class="button button-secondary tbl_button_delete_clean" value="Delete" name="delete_tbl"></div>'
                '</div>';
                switch (choise_option) {
                    case "line":
                        $('.container_group_setting .group_item_theme_sort').append(line_html);
                        break;

                    default:
                        alert('Select one option');
                }
            });

            $(document).delegate(".tbl_button_delete_clean", "click", function(event) {
                event.preventDefault();
                var elem = $(this).parent().parent();
                $.confirm({
                    'title': 'Delete Confirmation',
                    'message': 'You are about to delete this option. <br />It cannot be restored at a later time! Continue?',
                    'buttons': {
                        'Yes': {
                            'class': 'blue',
                            'action': function() {
                                elem.remove();
                            }
                        },
                        'No': {
                            'class': 'gray',
                            'action': function() {} // Nothing to do in this case. You can as well omit the action property.
                        }
                    }
                });
            });

            $(document).on('change', '.inputimg', function() {
                var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
                $(this).parent().find('.title_img').val(filename);
            });

            $(".group_item_theme_sort").sortable();
            new Sortable(group_item_theme_sort, {
                handle: '.icon_change_postion', // handle's class
                swap: true, // Enable swap plugin
                swapClass: 'highlight', // The class applied to the hovered swap item
                animation: 150
            });
        });
    </script>
@endpush
