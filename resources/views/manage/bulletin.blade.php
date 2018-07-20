@extends('layouts.manage')
@section('title')
    後台管理系統
@endsection
@section('content')
    <section>
        <div class="section-body">
            <div class="row">
                @if(count($errors) > 0)
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-head" style="background-color: #ff0e35">
                                <header>錯誤訊息</header>
                                <div class="tools">
                                    <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                    <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                                </div>
                            </div>
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div></div>
                    <!-- BEGIN  - FORM -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-head style-primary">
                                <header>公告管理</header>
                                <div class="tools">
                                    <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                    <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                                </div>
                            </div>
                            <div class="card-body">

                                <form class="form" role="form" action="" method="post">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            {{--<header>公告</header>--}}
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control" name="top_content" value="{{ $top_content }}" />
                                                    <label for="productName">首頁上方公告</label>
                                                </div>
                                                <div class="form-group floating-label">
                                                    <input type="text" class="form-control" name="product_content" value="{{ $product_content }}"/>
                                                    <label for="productName">商品上方公告</label>
                                                </div>
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


