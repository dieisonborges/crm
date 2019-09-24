    <div class="row">
        <div class="col-md-12" style="padding-bottom: 15px;">
                <!-- /.box-header -->

                  <a href="{{url('franqueados/'.$franquia->id.'/dashboard')}}" class="btn btn-default">
                    <i class="fa fa-tachometer-alt"></i>
                    Painel de Controle
                  </a>
                  
                  <a href="{{url('franqueados/'.$franquia->id.'/produtos/1')}}" class="btn btn-default">
                    <i class="fa fa-gifts"></i>
                    Produtos
                  </a>

                  <a href="{{url('franqueados/'.$franquia->id.'/pedidos')}}" class="btn btn-default">
                    <i class="fa fa-shopping-cart"></i>
                    Pedidos
                  </a>

                  <a href="{{url('franqueados/'.$franquia->id.'/clientes')}}" class="btn btn-default">
                    <i class="fa fa-user"></i>
                    Clientes
                  </a>

                  <a href="{{url('franqueados/'.$franquia->id.'/configuracoes')}}" class="btn btn-default" style="float: right;">
                    <i class="fa fa-cog"></i>
                    Clientes
                  </a>

                  


            </div>
            <!-- /.col -->
    </div>