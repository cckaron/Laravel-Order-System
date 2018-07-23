@extends('layouts.manage')
@section('title')
    後台管理系統
@endsection
@section('content')
    <section>
        <div class="section-body">
            <div class="row">

                <!-- INCLUDE MESSAGE -->
            @include('layouts.returnMessage')

                    <!-- BEGIN  - FORM -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-head style-primary">
                                <header>主頁管理</header>
                                <div class="tools">
                                    <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                    <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                                </div>
                            </div>
                            <div class="card-body">

                                <form class="form" role="form" action="" method="post">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h2 style="color:blue">公告</h2>
                                            <div class="form-group floating-label">
                                                <input type="text" class="form-control" name="top_title" value="{{ $top_title }}" />
                                                <label for="top_title">首頁上方——公告標題</label>
                                            </div>
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control" name="top_content" value="{{ $top_content }}" />
                                                    <label for="top_content">首頁上方——公告內容</label>
                                                </div>
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control" name="product_content" value="{{ $product_content }}"/>
                                                    <label for="product_content">商品上方——公告內容</label>
                                                </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <h2 style="color:blue">參數設定</h2>
                                            <div class="form-group floating-label">
                                                <input type="text" class="form-control" name="daily_max" value="{{ $daily_max }}" />
                                                <label for="top_title">每日限定數量</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <h2 style="color:blue; padding-bottom: 10px;">商家介紹</h2>
                                            <textarea rows="20" class="form-control" name="introduction">{{ $introduction }}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <hr>
                                            <div class="card-actionbar-row">
                                                <input type="submit" class="btn btn-flat btn-primary ink-reaction" value="確認修改">
                                            </div>
                                        </div>
                                    </div>
                                    {{ csrf_field() }}
                                </form>
                            </div><!--end .card-body -->
                        </div><!--end .card -->
                    </div><!--end .col -->
                    <!-- END FORM - TIME ON SITE -->

            </div><!--end .row -->
        </div><!--end .section-body -->
    </section>
@endsection

@section('scripts')
    <script>tinymce.init({
            selector:'textarea',
            plugins:'link code image imagetools textcolor',
            branding:false,
            toolbar: "fontsizeselect forecolor backcolor",
            fontsize_formats: "8px 10px 12px 14px 16px 18px 24px 36px"
        });</script>
@endsection


