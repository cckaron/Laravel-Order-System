@extends('layouts.master')
@section('title')
    曌咖工作坊
@endsection
@section('style')
    <style type="text/css">
        div.appearDiv{
            display:None
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
    <br><br>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">

            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    <p>{{ $error }}</p>
                </div>
            @endforeach

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <p>{{ session()->get('message') }}</p>
                    </div>

                @endif

            <h3 class="text-center">
                <ruby>曌 <rt> ㄓㄠˋ </rt></ruby>咖手感烘焙訂購單
            </h3>
            <!-- carousel start -->
        @include('partials.carousel')
        <!-- introduce start -->
            @include('partials.introduce')
            <hr>
            <!-- form start -->
            @include('partials.orderform')
        </div>
        <div class="col-md-2">
        </div>
    </div>
    </div>
    <br><br><br>
@endsection

@section('scripts')
    <script>
        $("#datepicker").change(function () {
            $passDate = $(this).val();

            $.ajax({
                type: 'GET',
                url: 'ajax/check/',
                data: {
                    'Date': $passDate
                },
                dataType: 'json',
                success: function(data){
                    if (data.available){
                        $("div#behind").show();
                        $("#dis_TextInput").show();
                        $("h5#front_Datetext").width(100);
                        $("h5#front_Datetext").text('當日尚有');
                        $("div#appearDivControl").removeClass("appearDiv");
                        $("#dis_TextInput").val(data.canBuy);
                        alert('當日尚有 '+data.canBuy+'個麵包可供訂購！');
                    }
                    else{
                        $("div#appearDivControl").removeClass("appearDiv");
                        $("h5#appearText").text('很抱歉! '+$passDate+ ' 的訂單已滿，請選擇其他日期訂購。');
                        $("#dis_TextInput").hide();
                        $("div#behind").hide();
                        $("h5#front_Datetext").width(800);
                        $("h5#front_Datetext").text('當日訂單已滿!請您改選其他日期，謝謝。');
                        alert('當日可訂購數量已滿！請選擇其他日期，謝謝');
                    }
                }
            })
        });

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

            var disableddates = ['7-13-2018'];

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

    <script>
        $('form').submit(function(){
            var sum = 0;
            $(".custom-select").each(function(){
                sum += parseInt(this.value);
            });

            if (sum == 0)
            {
                $('#not-success').text("訂購數量不可為零！");
                $('#not-success-section').show();
                return false;
            }
            else if (sum > $('#dis_TextInput').val() && $('#dis_TextInput').val()!=0 ){
                $('#not-success').text('超過當日可訂購量！'+ $('#datepicker').val()+'剩餘'+$('#dis_TextInput').val()+'個麵包可供訂購');
                $('#not-success-section').show();
                return  false;
            }
            else if ($('#dis_TextInput').val() == 0)
            {
                $('#not-success').text('請選擇預訂日期！');
                $('#not-success-section').show();
                return false;
            }

        })
    </script>

    <script>
        $(".custom-select").change(function(){
            var sum = 0;
            $(".custom-select").each(function(){
                sum += parseInt(this.value);
            });
            $('#total_bread').text(sum);
        });
    </script>

    <script>
        $(".custom-select").change(function(){
            var total = 0;
            $(".gradeX").each(function(){
                var sum = 0;
                var price = 0;
                $(this).find('.custom-select').each(function(){
                    sum += parseInt(this.value);
                });
                $(this).find('.product_price').each(function(){
                    price = parseInt($(this).text());
                });
                total += sum*price;
            });
            $('#total_dollar').text(total);

            // Give this input field the total dollar value and then pass it to views
            // Don't need to pass the total bread because it will be calculated in views
            $('.total_dollar').val(total);
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