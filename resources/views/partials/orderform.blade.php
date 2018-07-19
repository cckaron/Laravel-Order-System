<form action="{{ route('product.index') }}" method="post" style="padding-top:10px; padding-bottom:200px">
    {{--{% csrf_token %}--}}
    <div class="form-group">
        <h2 class="text-primary" style="padding-bottom:10px">您的大名</h2>
        <div class="form-group row">
            <div class="col-xs-3" style="padding-left:15px">
                <input type="text" class="form-control" name="{{ $columns[1] }}">
            </div>
        </div>
    </div>
    <!-- 連絡電話 -->
    <h2 class="text-primary" style="padding-bottom:10px">連絡電話(已加入LINE群組者可免填)</h2>
    <div class="form-group row">
        <div class="col-xs-3" style="padding-left:15px">
            <input type="text" class="form-control" name="{{ $columns[2] }}">
        </div>
    </div>
    <!-- 取貨地點 -->
    <div style="padding-top:20px">
        <h2 class="text-primary">取貨地點</h2>
        <div class="radio">
            <label>
                <input type="radio" id="cSpot" name="{{ $columns[4] }}" value="自取" checked/>
                自取(當日17:00~21:00)
            </label>
            <label>
                <input type="radio" id="cSpot" name="{{ $columns[4] }}" value="慈科大"/>
                慈科大(週二．五)
            </label>
            <label>
                <input type="radio" id="cSpot" name="{{ $columns[4] }}" value="榮服處"/>
                榮服處(週一．四)
            </label>
        </div>
        <br>
    </div>
    <!-- 日期 -->
    <div class ="form-group" style="padding-top:20px">
        <h2 class="text-primary">取貨日期</h2>
        {{--
        <h6 class="text-success">註 : 每日麵包限量為 {{available_Count}} 條！ </h6>
        --}}
        <h6 class="text-secondary">週六、日為店休，請勿訂購，謝謝!</h6>
    </div>
    <div class="form-group row">
        <div class="col-xs-3" style="padding-left:10px">
            <input type="text" class="form-control" placeholder="請選擇日期" id="datepicker" name="{{ $columns[3] }}">
        </div>
    </div>
    <div class="row-fluid appearDiv" id="appearDivControl">
        <div class="span-3">
            <div style="overflow:auto;width:90%;">
                <div style="width:600px;">
                    <fieldset disabled>
                        <div style="display:inline-block;width:100px;" id="front">
                            <h5 id="front_Datetext" class="text-success">當日尚有 </h5>
                        </div>
                        <div style="display:inline-block;width:60px;"><input type="disabledTextInput" aling="center" id="dis_TextInput" class="form-control" placeholder="Disabled input"></div>
                        <div style="display:inline-block;width:200px;" id="behind">
                            <h5 id="beh_DateText" class="text-success"> 個麵包可供訂購! </h5>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="padding-top:50px; padding-bottom:60px">
        <h2 class="text-primary" style="padding-bottom:30px">訂購產品</h2>
        <section>
            <div class="section-body">
                <!-- BEGIN DATATABLE 2 -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped" >
                                <thead>
                                <tr>
                                    <th style="width: 5%"></th>
                                    <th style="width: 5%; text-align:center"> 不切片 </th>
                                    <th style="width: 5% ; text-align:center"> 切厚片 </th>
                                    <th style="width: 5% ; text-align:center"> 切薄片 </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($products->chunk(1) as $productChunk)

                                    @foreach($productChunk as $product)
                                <tr class="gradeX">
                                    <td>
                                        <span style="font-weight:bold">{{$product->title}}</span> <br> {{$product->price}}元 / {{$product->unit}}
                                    </td>


                                    <td>
                                        <select class="custom-select form-control" style="width:auto;" id="{{ $product->id_notSlice }}" name="{{ $product->id_notSlice }}">
                                            <option value="0" selected>請選擇數量...</option>
                                            <option value="1">1條</option>
                                            <option value="2">2條</option>
                                            <option value="3">3條</option>
                                            <option value="4">4條</option>
                                            <option value="5">5條</option>
                                            <option value="6">6條</option>
                                            <option value="7">7條</option>
                                            <option value="8">8條</option>
                                            <option value="9">9條</option>
                                            <option value="10">10條</option>
                                            <option value="11">11條</option>
                                            <option value="12">12條</option>
                                        </select>
                                    </td>

                                    @if($product->thickSlice)
                                    <td>
                                        <select class="custom-select col-xs-2 form-control" style="width:auto;" id="{{ $product->id_thickSlice }}t" name="{{ $product->id_thickSlice }}">
                                            <option value="0" selected>請選擇數量...</option>
                                            <option value="1">1條</option>
                                            <option value="2">2條</option>
                                            <option value="3">3條</option>
                                            <option value="4">4條</option>
                                            <option value="5">5條</option>
                                            <option value="6">6條</option>
                                            <option value="7">7條</option>
                                            <option value="8">8條</option>
                                            <option value="9">9條</option>
                                            <option value="10">10條</option>
                                            <option value="11">11條</option>
                                            <option value="12">12條</option>
                                        </select>
                                    </td>
                                    @endif

                                    @if(!$product->thickSlice)
                                        <td>
                                            此口味不提供切厚片
                                        </td>
                                    @endif

                                    @if($product->thinSlice)
                                        <td>
                                            <select class="custom-select col-xs-2 form-control" style="width:auto;" id="{{ $product->id_thinSlice }}" name="{{ $product->id_thinSlice }}">
                                                <option value="0" selected>請選擇數量...</option>
                                                <option value="1">1條</option>
                                                <option value="2">2條</option>
                                                <option value="3">3條</option>
                                                <option value="4">4條</option>
                                                <option value="5">5條</option>
                                                <option value="6">6條</option>
                                                <option value="7">7條</option>
                                                <option value="8">8條</option>
                                                <option value="9">9條</option>
                                                <option value="10">10條</option>
                                                <option value="11">11條</option>
                                                <option value="12">12條</option>
                                            </select>
                                        </td>
                                    @endif

                                    @if(!$product->thinSlice)
                                        <td>
                                            此口味不提供切薄片
                                        </td>
                                    @endif
                                </tr>
                                {{--{% endfor %}--}}
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--end .table-responsive -->
                    </div>
                    <!--end .col -->
                </div>
                <!--end .row -->
                <!-- END DATATABLE 2 -->
            </div>
            <!--end .section-body -->
        </section>
    </div>
    <div style="text-align:left">
        <input type="submit" name="button" id="button" class="btn btn-primary" value="送出訂單">
    </div>
    {{ csrf_field() }}
</form>