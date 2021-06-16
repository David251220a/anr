{!! Form::open(array('url'=>'acceso/usuario', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}

    <div class="form-group">

        <div class="input-group">

        <input type="search" class="form-control" name="searchtext" placeholder="Buscar.." value="{{$searchtext}}">
        {{-- AGREGAR UN BOTON A LADO PARA QUE SE QUEDE MAS LINDO --}}
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </span>

        </div>

    </div>

{{Form::close() }}