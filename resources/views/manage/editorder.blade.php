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
                            <header>編輯商品</header>
                            <div class="tools">
                                <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            <form class="form" role="form" action="{{ route('manage.postEditOrder') }}" method="post">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <header>商品資訊</header>

                                        @for($k=0; $k<1; $k++)
                                            <div class="form-group floating-label">
                                                @php($column = $columns[$k])
                                                <input type="text" class="form-control" name="{{ $columns[$k] }}" value="{{ $order-> $column }}" readonly/>
                                                <label for="productName">ID (自動生成)</label>
                                            </div>
                                        @endfor

                                        @for($i=1; $i<count($columns); $i++)
                                            @if($i != 5 and $i != 6)
                                        <div class="form-group floating-label">
                                            @php($column = $columns[$i])
                                            <input type="text" class="form-control" name="{{ $columns[$i] }}" value="{{ $order-> $column }}"/>
                                            <label for="productName">{{ $columns[$i] }}</label>
                                        </div>

                                                @else
                                                <div class="form-group floating-label">
                                                    @php($column = $columns[$i])
                                                    <input type="text" class="form-control" name="{{ $columns[$i] }}" value="{{ $order-> $column }}" readonly/>
                                                    <label for="productName">{{ $columns[$i] }} （自動更新）</label>
                                                </div>
                                            @endif

                                        @endfor
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


