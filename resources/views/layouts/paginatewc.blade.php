                <nav class="col-md-12 text-center">
                    <ul class="pagination"> 

                            <li class="page-item">
                                <a class="page-link" href="{{url($linkPaginate.'1')}}" rel="first" aria-label="&laquo; Primeiro">Primeiro</a>
                            </li>

                            @if(!($page==1))
                            <li class="page-item">
                                <a class="page-link" href="{{url($linkPaginate.($page-1))}}" rel="prev" aria-label="&laquo; Anterior">&lsaquo;</a>
                            </li>
                            @endif

                            @for ($i = 1; $i < $totalPages; $i++)

                                @if($page==$i)
                                <li class="page-item page-item active">
                                    <a class="page-link" href="{{url($linkPaginate.$i)}}" rel="{{ $i }}" aria-label="&laquo; {{ $i }}">{{ $i }}</a>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{url($linkPaginate.$i)}}" rel="{{ $i }}" aria-label="&laquo; {{ $i }}">{{ $i }}</a>
                                </li>
                                @endif
                            @endfor
                        
                            @if(!($page==$totalPages))
                            <li class="page-item">
                                <a class="page-link" href="{{url($linkPaginate.($page+1))}}" rel="next" aria-label="Próxima &raquo;">&rsaquo;</a>
                            </li>
                            @endif

                            <li class="page-item">
                                <a class="page-link" href="{{url($linkPaginate.$totalPages)}}" rel="last" aria-label="&laquo; Último">Último</a>
                            </li>
                    </ul>
                </nav>