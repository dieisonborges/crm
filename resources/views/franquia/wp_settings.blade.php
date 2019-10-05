@extends('layouts.app')
@section('title', 'Regras')
@section('content')


    <h1>
        <i class="fa fa-tools"></i> Settings Wordpress Woocommerce Franquia: <b>{{ $franquia->codigo_franquia }}</b>
        <small>{{$franquia->nome}}</small>
    </h1>

    <hr>

    <div class="row">
        <div class="col-md-12">
              <!-- Custom Tabs -->           

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @php
                        $count=1;
                    @endphp
                    @foreach($settings as $setting)
                        @if($count==1)
                            <li class="active"><a href="#tab_{{$count}}" data-toggle="tab">{{$setting->id}}</a></li>
                        @else
                            <li><a href="#tab_{{$count}}" data-toggle="tab">{{$setting->id}}</a></li>
                        @endif
                        @php
                            $count++;
                        @endphp
                    @endforeach
                    
                </ul>
                <div class="tab-content">
                    @php
                        $count=1;
                    @endphp
                    @foreach($settings as $setting)
                        @if($count==1)
                            <div class="tab-pane active" id="tab_{{$count}}">
                                <pre>
                                    {{print_r($setting)}}
                                </pre>

                            </div>
                        @else
                            <div class="tab-pane" id="tab_{{$count}}">
                                <pre>
                                    {{print_r($setting)}}
                                </pre>

                            </div>
                        @endif
                        @php
                            $count++;
                        @endphp
                    @endforeach                    
                    
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->

            <a href="javascript:history.go(-1)" class="btn btn-info"><i class="fa fa-undo"></i> Voltar</a>

        </div>
        <!-- /.col-md-12 -->



    </div>
    <!-- /.row -->
   

@endsection
