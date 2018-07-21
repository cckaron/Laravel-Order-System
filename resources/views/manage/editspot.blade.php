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
                            <header>編輯取貨地點</header>
                            <div class="tools">
                                <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form class="form" role="form" action="{{ route('manage.postEditSpot') }}" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <header>詳細資訊</header>
                                        @foreach($spots as $spot)
                                            <div class="form-group floating-label" hidden>
                                                <input type="text" class="form-control" style="color: rgba(118,113,112,0.96)" name="id" value="{{ $spot->id }}" readonly/>
                                                <label for="productName">ID (自動生成）</label>
                                            </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="spot" value="{{ $spot->spot }}"/>
                                            <label for="productName">取貨地點</label>
                                        </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="sequence" value="{{ $spot->sequence }}"/>
                                            <label for="productPrice">顯示順序 (「 1 」顯示在最前面)</label>
                                        </div>
                                        <div class="form-group floating-label">
                                            <input type="text" class="form-control" name="content" value="{{ $spot->content }}"/>
                                            <label for="productUnit">顯示內容</label>
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


