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
                            <header>所有休息日（假日除外）</header>
                            <div class="tools">
                                <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            <section style="float:left">
                                <span style="padding-right: 20px">
                                <input name="add" id="add_data" type="submit" class="btn btn-success" value="批量新增"/>
                                </span>
                                <input type="button" class="btn btn-default" onclick="window.location.reload()" value="重新整理" />
                            </section>

                            <div id="dateModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post" id="date_form">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">
                                                    &times;
                                                </button>
                                                <h4 class="modal-title">批量新增日期</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{ csrf_field() }}
                                                <span style="color: rgba(214,51,39,0.96)">提醒：新增完成後請重新整理頁面</span>
                                                <span id="form_output"></span>
                                                <div class="form-group">
                                                    <label>選擇日期</label>
                                                    <input type="text" name="date" id="datepicker" class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="button_action" id="button_action" value="插入" />
                                                <input type="submit" name="submit" id="action" value="新增" class="btn btn-info">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="datatable1" class="table order-column hover">
                                    <thead>
                                    <tr>
                                        <th width="10px" hidden>ID</th>
                                        <th width="10px">日期</th>
                                        <th width="10px">動作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($holidays->chunk(1) as $holidayChunk)

                                        @foreach($holidayChunk as $holiday)
                                            <tr class="gradeX">
                                                <td hidden>{{$holiday->id}}</td>
                                                <td>{{$holiday->date}}  ({{ $days[date('w', strtotime($holiday->date))] }})</td>
                                                <td>
                                                    <a href="{{ route('manage.destroyHoliday', $holiday->id) }}" class="btn ink-reaction btn-floating-action btn-danger" onclick="return confirm('確定刪除?')"><i class="md md-delete"></i> </a>
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
                var wb = XLSX.utils.table_to_book(document.getElementById('datatable1'),{sheet:"日期"});

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

            $('#add_data').click(function(){
                $('#dateModal').modal('show');
                $('#date_form')[0].reset();
                $('#form_output').html('');
                $('#button_action').val('插入');
                $('#action').val('新增');
            })

            $('#date_form').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url:'{{ route('ajaxdata.postdata') }}',
                    method:"POST",
                    data:form_data,
                    dataType:"json",
                    success:function(data)
                    {
                        if (data.error.length > 0)
                        {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++)
                            {
                                error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                            }
                            $('#form_output').html(error_html);
                        }
                        else
                        {
                            $('#form_output').html(data.success);
                            $('#date_form')[0].reset();
                            $('#action').val('新增');
                            $('.modal-title').text('批量新增日期');
                            $('#button_action').val('插入');
                        }
                    }
                })
            })
        });
    </script>

    <script>

        $.datepicker.regional['zh-TW']={
            dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
            dayNamesMin:["日","一","二","三","四","五","六"],
            monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
            monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
            prevText:"上月",
            nextText:"次月",
            weekHeader:"週"
        };

        $.datepicker.setDefaults($.datepicker.regional["zh-TW"]);
        $( function() {

            // var disableddates = ['7-13-2018'];

            var disableddates = {!! json_encode($holidayArray) !!};


            function DisableSpecificDates(date){
                var m = date.getMonth();
                var d = date.getDate();
                var y = date.getFullYear();

                var currentdate = (m + 1) + '-' + d + '-' + y;

                for (var i = 0; i <disableddates.length; i++){
                    if ($.inArray(currentdate, disableddates) != -1){
                        return [false];
                    }
                }

                var weekenddate = $.datepicker.noWeekends(date);
                return weekenddate;
            }

            $( "#datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                beforeShowDay: DisableSpecificDates
            });
        });

    </script>

    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
