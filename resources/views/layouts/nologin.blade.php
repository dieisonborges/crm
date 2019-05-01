<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  @include('layouts.head')

<body class="hold-transition {{ config('app.skin') }} sidebar-mini sidebar-collapse" id="body-nologin">
<div class="wrapper">
  
   
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">  

      <div class="row">         

          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">

                <div class="col-md-4" style="float: right;">
                  <a href="/">
                      <b style="display:none;">{{ config('app.name') }}</b>        
                      <img src="{{ asset('img/logo/logo-ecardume-sem-borda.png') }}" width="80%">        
                  </a>     
                </div>

                @include('layouts.error')

                @yield('content')
                
              </div>
            </div>
            
          </div>          

      </div>


    </section>
    <!-- /.content -->
  </div>
 
  @include('layouts.footer')

</div>
<!-- ./wrapper -->

@include('layouts.scripts')


</body>
</html>
