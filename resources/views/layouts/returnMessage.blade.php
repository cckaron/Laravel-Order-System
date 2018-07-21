@if(count($errors) > 0)
    <section>
    <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-head" style="background-color: #ff0e35">
                <header>錯誤訊息</header>
                <div class="tools">
                    <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                    <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                </div>
            </div>
            <div class="card-body">
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    <p>{{ $error }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div></div>
    </div>
    </section>


    @if(session()->has('message'))
        <section>
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-head" style="background-color: rgba(236,99,80,0.96)">
                    <header>訊息</header>
                    <div class="tools">
                        <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                        <a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
                    </div>
                </div>

                {{--need to add 'message' in view--}}
                <div class="card-body">
                <div class="alert alert-success">
                    <p>{{ session()->get('message') }}</p>
                </div>
                </div>
            </div></div>
        </div>
        </section>
    @endif