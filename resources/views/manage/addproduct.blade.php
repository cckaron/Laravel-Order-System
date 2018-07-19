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
                            <header>新增商品</header>
                            <div class="tools">
                                <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form class="form" role="form" action="{{ route('manage.addProduct') }}" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <header>商品資訊</header>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="title"/>
                                            <label for="productName">品名</label>
                                        </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="price"/>
                                            <label for="productPrice">價格 (單位：元)</label>
                                        </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="unit"/>
                                            <label for="productUnit">單位 (例如：條)</label>
                                        </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="description"/>
                                            <label for="productDescription">描述</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="custom-select-sm form-control" name="thickSlice">
                                                <option value="0">是否可以切厚片？</option>
                                                <option value="1">可以切厚片</option>
                                                <option value="0">不可以切厚片</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="custom-select-sm form-control" name="thinSlice">
                                                <option value="0">是否可以切薄片？</option>
                                                <option value="1">可以切薄片</option>
                                                <option value="0">不可以切薄片</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="card-actionbar-row">
                                            <input type="submit" class="btn btn-flat btn-primary ink-reaction" value="送出">
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


