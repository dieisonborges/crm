<!-- /.content-wrapper -->
<footer class="main-footer" id="footer">
  <div class="pull-right">
    Cotações: <b>USD:</b> R${{number_format(Session::get('cambio_usd'),2)}} | <b>RMB/CNY:</b> R${{number_format(Session::get('cambio_cny'),2)}} | <b>EUR:</b> R${{number_format(Session::get('cambio_eur'),2)}}
  </div>

  <div>
    <strong>Copyright &copy; 2018 <a href="http://www.ecardume.com.br" target="_blank">{{ config('app.name') }}</a>.</strong> License: <a href="http://www.ecardume.com.br" target="_blank"> e-Cardume®</a>.

    <hr class="hr">
    <!--
    <small>Acesso   </small>
    <small>País: <b class="geo-country"></b></small>
    <small>Estado: <b class="geo-state"></b></small>
    <small>Cidade: <b class="geo-city"></b></small>
    <small>IP: <b class="geo-ip"></b></small>
    -->

    <small>Customer Relationship Management by <a href="http://montetecnologia.com.br" target="_blank">Monte Tecnologia</a></small>

    <div style="float: right;">

      <b>Version</b> {{ config('app.version') }} <small>Comp: {{ config('app.compilation') }}</small>
      
      <a href="{{ url('/contato') }}" class="dropdown-toggle" alt="Bugs">
        <i class="fa fa-envelope"></i>
      </a> 

    </div>
                   


  </div>
</footer>

  