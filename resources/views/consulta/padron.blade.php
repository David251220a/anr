@extends('layouts.admin')

@section('contenido')

    {!! Form::open(array('route' => 'consulta.padron', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}
        
        <div class="form-group">

            <div class="input-group">

                <input type="search" class="form-control" name="searchtext"  placeholder="Buscar.." value="{{$searchtext}}">        
                <span class="input-group-btn">
                <button type="submit" class="btn btn-primary">Buscar</button>

            </span>

            </div>

        </div>

    {{Form::close() }}

    <div class="row">

        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

            <div class="table-responsive">

                <table id="detalles" class="table table-striped table-condensed table-bordered table-hover table-responsive">

                    <thead style="background-color:#f71808a8">

                        <th style="text-align: center; font-size: 1.2rem">Cedula</th>
                        <th style="text-align: center; font-size: 1.2rem">Apellido y Nombre</th>
                        <th style="text-align: center; font-size: 1.2rem">Local</th>
                        <th style="text-align: center; font-size: 1.2rem">M</th>
                        <th style="text-align: center; font-size: 1.2rem">O</th>
                        
                    </thead>

                    @if (count($votante))

                        <tbody>

                            @foreach ($votante as $vota)
                            
                                <tr>
                                    
                                    <td style="text-align: right; font-size: 1.2rem">{{number_format($vota->cedula, 0, ".", ".")}} <input type="hidden" name="codpadron" value="{{$vota->CodPadron}}"></td>
                                    <td style="text-align: center; font-size: 1.2rem">{{$vota->apellido_nombre}}</td>
                                    <td style="text-align: center; font-size: 1.2rem">{{$vota->Desc_Local}}</td>
                                    <td style="text-align: right; font-size: 1.2rem">{{$vota->mesa}}</td>
                                    <td style="text-align: right; font-size: 1.2rem">{{$vota->orden}}</td>                                    
                                    
                                </tr>

                            @endforeach

                        </tbody>                    
                        
                    @else

                        <tfoot>

                            <tr style="background-color:#ede7e6a8">

                                <td colspan="8" style="text-align: center"><h3><b> "No figura en la Ciudad de Limpio" </b></h3></td>
                            </tr>
                        </tfoot>
                    
                    @endif

                </table>

            </div>

            {{-- {{$votante-> links()}} --}}
            {{$votante->appends(['searchtext' => $searchtext])->links()}}

        </div>
    </div>

@endsection