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
                            <header>所有訂單</header>
                            <div class="tools">
                                <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <section class="row" style="float:right">
                                <input id="btn-export" type="submit" class="btn btn-primary" value="匯出excel"/>
                            </section>

                            <div class="table-responsive">
                                <table id="datatable1" class="table order-column hover">
                                    <thead>
                                    <tr>
                                        @foreach($columns as $column)
                                            @if($column == 'created_at')
                                                <th width="20px">
                                                訂單成立時間
                                                </th>
                                            @elseif($column == 'updated_at')
                                                   @continue
                                                @else
                                                <th width="20px">
                                                {{ $column }}
                                            </th>

                                            @endif
                                        @endforeach
                                        <th width="50px">動作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders->chunk(1) as $orderChunk)

                                        @foreach($orderChunk as $order)
                                    <tr class="gradeX">
                                        @foreach($columns as $column)
                                            @if($column !='updated_at')
                                        <td>{{ $order->$column }}</td>
                                                @else
                                                    @continue
                                            @endif
                                        @endforeach
                                        <td>
                                            <a href="{{ route('manage.destroyOrder', $order->id) }}" class="btn ink-reaction btn-floating-action btn-danger" onclick="return confirm('確定刪除?')"><i class="md md-delete"></i> </a>
                                            <a href="{{ route('manage.editOrder', $order->id) }}" class="btn ink-reaction btn-floating-action btn-warning"><i class="md md-edit"></i> </a>
                                        </td>

                                    </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end .table-responsive -->
                        </div>
                    </div>
                </div>
                <!--end .col -->
            </div>
            <!--end .row -->
            <!-- END DATATABLE 2 -->
        </div>
        <!--end .section-body -->
    </section>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $("#btn-export").click(function(){
            var search = $('input').eq(1).val();
            var wb = XLSX.utils.table_to_book(document.getElementById('datatable1'),{sheet:"訂購表"});

            if (search){
                var content = prompt("請輸入檔案名稱:", String(search));
                if (content === null){
                    return;
                }
                var filename = content +".xlsx";
                XLSX.writeFile(wb, filename)

            } else {
                XLSX.writeFile(wb, '所有訂購單.xlsx')
            }

        });
    });
</script>
@endsection