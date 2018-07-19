@extends('layouts.manage')
@section('title')
    後台管理系統
@endsection
@section('content')
    <section>
        <div class="section-body">
            <!-- BEGIN DATATABLE 2 -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-head style-primary">
                            <header>所有商品資料</header>
                            <div class="tools">
                                <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <section style="float:right">
                                <input id="btn-export" type="submit" class="btn btn-primary" value="匯出excel"/>
                            </section>
                            <div class="table-responsive">
                                <table id="datatable1" class="table order-column hover">
                                    <thead>
                                    <tr>
                                        <th width="30px">順序</th>
                                        <th width="70px">商品名稱</th>
                                        <th width="100px">商品描述</th>
                                        <th width="50px">價格</th>
                                        <th width="30px">可切片</th>
                                        <th width="30px">切厚片</th>
                                        <th width="30px">切薄片</th>
                                        <th width="70px">動作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products->chunk(1) as $productChunk)

                                        @foreach($productChunk as $product)
                                    <tr class="gradeX">
                                        <td>{{$product->sequence}}</td>
                                        <td>{{$product->title}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            @if( $product->canSlice == True)
                                                可
                                            @else
                                                不可
                                            @endif
                                        </td>
                                        <td>
                                            @if( $product->thickSlice == True)
                                                可
                                            @else
                                                不可
                                            @endif
                                        </td>
                                        <td>
                                            @if( $product->thinSlice == True)
                                                可
                                            @else
                                                不可
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('manage.destroyProduct', $product->id) }}" class="btn ink-reaction btn-floating-action btn-danger" onclick="return confirm('確定刪除?')"><i class="md md-delete"></i> </a>
                                            <a href="{{ route('manage.editProduct', $product->id) }}" class="btn ink-reaction btn-floating-action btn-warning"><i class="md md-edit"></i> </a>
                                            <a href="" class="btn ink-reaction btn-floating-action btn-primary"><i class="md md-print"></i> </a>
                                        </td>
                                    </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                    {{ csrf_field() }}
                                </table>
                            </div><!--end .table-responsive -->
                        </div>
                    </div>
                </div><!--end .col -->
            </div><!--end .row -->
            <!-- END DATATABLE 2 -->

        </div><!--end .section-body -->
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            $("#btn-export").click(function(){
                var search = $('input').eq(1).val();
                var wb = XLSX.utils.table_to_book(document.getElementById('datatable1'),{sheet:"商品"});

                if (search){
                    var content = prompt("請輸入檔案名稱:", String(search));
                    if (content === null){
                        return;
                    }
                    var filename = content +".xlsx";
                    XLSX.writeFile(wb, filename)

                } else {
                    XLSX.writeFile(wb, '所有商品.xlsx')
                }

            });
        });
    </script>
@endsection
