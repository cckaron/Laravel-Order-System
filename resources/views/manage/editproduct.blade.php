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
                            <header>編輯商品</header>
                            <div class="tools">
                                <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form class="form" role="form" action="{{ route('manage.postEditProduct') }}" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <header>商品資訊</header>
                                        @foreach($products as $product)
                                            <div class="form-group floating-label" hidden>
                                                <input type="text" class="form-control" style="color: rgba(118,113,112,0.96)" name="id" value="{{ $product->id }}" readonly/>
                                                <label for="productName">商品ID (不可更改）</label>
                                            </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="title" value="{{ $product->title }}"/>
                                            <label for="productName">品名</label>
                                        </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="price" value="{{ $product->price }}"/>
                                            <label for="productPrice">價格 (單位：元)</label>
                                        </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="unit" value="{{ $product->unit }}"/>
                                            <label for="productUnit">單位 (例如：條)</label>
                                        </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="description" value="{{ $product->description }}"/>
                                            <label for="productDescription">描述</label>
                                        </div>
                                        <div class="form-group">
                                            {{--<select class="custom-select-sm form-control" name="thickSlice" value="{{ $product->thickSlice }}">--}}
                                                {{--<option value=1>可以切厚片</option>--}}
                                                {{--<option value=0>不可以切厚片</option>--}}
                                            {{--</select>--}}
                                            <select class="custom-select-sm form-control" name="thickSlice" value="{{ $product->thickSlice }}">
                                                <option value=1 @if ( $product->thickSlice == 1 ) selected = "selected" @endif>可以切厚片</option>
                                                <option value=0 @if ( $product->thickSlice == 0 ) selected = "selected" @endif>不可以切厚片</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="custom-select-sm form-control" name="thinSlice" value="{{ $product->thinSlice }}">
                                                <option value=1 @if ( $product->thinSlice == 1 ) selected = "selected" @endif>可以切薄片</option>
                                                <option value=0 @if ( $product->thinSlice == 0 ) selected = "selected" @endif>不可以切薄片</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endforeach
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


