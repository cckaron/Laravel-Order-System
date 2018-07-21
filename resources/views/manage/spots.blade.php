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
                            <header>所有取貨地點</header>
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
                                        <th width="100px">顯示順序 (「 1 」顯示在最前面)</th>
                                        <th width="70px">取貨地點</th>
                                        <th width="100px">顯示內容</th>
                                        <th width="50px">動作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($spots->chunk(1) as $spotChunk)

                                        @foreach($spotChunk as $spot)
                                    <tr class="gradeX">
                                        <td>{{$spot->sequence}}</td>
                                        <td>{{$spot->spot}}</td>
                                        <td>{{$spot->content}}</td>
                                        <td>
                                            <a href="{{ route('manage.destroySpot', $spot->id) }}" class="btn ink-reaction btn-floating-action btn-danger" onclick="return confirm('提醒：刪除後所有訂單將一併更改，確定刪除?')"><i class="md md-delete"></i> </a>
                                            <a href="{{ route('manage.editSpot', $spot->id) }}" class="btn ink-reaction btn-floating-action btn-warning"><i class="md md-edit"></i> </a>
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
                var wb = XLSX.utils.table_to_book(document.getElementById('datatable1'),{sheet:"取貨地點"});

                if (search){
                    var content = prompt("請輸入檔案名稱:", String(search));
                    if (content === null){
                        return;
                    }
                    var filename = content +".xlsx";
                    XLSX.writeFile(wb, filename)

                } else {
                    XLSX.writeFile(wb, '所有取貨地點.xlsx')
                }

            });
        });
    </script>
@endsection
