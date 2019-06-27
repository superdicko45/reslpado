

<form class="form-horizontal" id="form" accept-charset="UTF-8" method="post" action="{{ url('/gform') }}" role="form">
    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}"> 

    @foreach($definicion as $key=>$item)
        
        @if($item['tipo'] == 'label')
        <hr>
          <div class="form-group">
            <div class="col-lg-8">
              <label for="{{ $key }}">
                
                <strong>{{ $item['nombre'] }}</strong>

              
              </label>
            </div>      
          </div>
        <br>  
        @elseif($item['tipo'] == 'phone')
          <div class="form-group">
            <div class="col-lg-4">
              
              <label for="{{ $key }}">{{ $item['nombre'] }}</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control bfh-phone" type="text" name="{{ $key }}" placeholder="(+52)" data-format="dd dd dd dd dd" 
              value="{{\Session::get('dataFaseActual.0.'.$key)}}" >
             
            </div>
          </div>
           @elseif($item['tipo'] == 'mail')
          <div class="form-group">
            <div class="col-lg-4">
             
              <label for="{{ $key }}">{{ $item['nombre'] }}</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control bfh-phone" type="mail" name="{{ $key }}" placeholder="E-mail" 
              value="{{\Session::get('dataFaseActual.0.'.$key)}}" >
             
            </div>
          </div>
        @elseif($item['tipo'] == 'integer')
          <div class="form-group">
            <div class="col-lg-4">
              
              <label for="{{ $key }}">{{ $item['nombre'] }}</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control {{ $item['tipo'] }}" type="number" name="{{ $key }}" placeholder="Ingrese {{ lcfirst(mb_strtolower($item['nombre'])) }}"  value="{{\Session::get('dataFaseActual.0.'.$key)}}" >
             
            </div>
          </div>  
        @elseif($item['tipo'] == 'password')
          <div class="form-group">
            <div class="col-lg-4">
              
              <label for="{{ $key }}">{{ $item['nombre'] }}</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control {{ $item['tipo'] }}" type="password" name="{{ $key }}" placeholder="Ingrese {{ lcfirst(mb_strtolower($item['nombre'])) }}">
             
            </div>
          </div>    
        @elseif($item['tipo'] == 'date')
          <div class="form-group">
            <div class="col-lg-4">
              <label for="{{ $key }}">{{ $item['nombre'] }}</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control {{ $item['tipo'] }}" type="text" 
              name="{{ $key }}" placeholder="aaaa-mm-dd" value="{{\Session::get('dataFaseActual.0.'.$key)}}"  
              {{\Session::get('disabled')}}>
            </div>
          </div>

       @elseif($item['tipo'] == 'horario')
          
          <div class="form-group">
            <div class="col-lg-4">
              <label for="{{ $key }}">{{ $item['nombre'] }}</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control {{ $item['tipo'] }}" type="text" 
              name="{{ $key }}" placeholder="Ej. 9.30 am - 11.30 am" value="{{\Session::get('dataFaseActual.0.'.$key)}}"  
              {{\Session::get('disabled')}}>
            </div>
          </div>
    
        @elseif($item['tipo'] == 'datetime')
          <div class="form-group">
            <div class="col-lg-4">
              <label for="{{ $key }}">{{ $item['nombre'] }}</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control {{ $item['tipo'] }}" type="text" 
              name="{{ $key }}" placeholder="aaaa-mm-dd hh-mm-ss" value="{{\Session::get('dataFaseActual.0.'.$key)}}"  
              {{\Session::get('disabled')}}>
            </div>
          </div>  
        @elseif($item['tipo'] == 'hidden')
          
          <input type="hidden" name="{{$key}}" value="{{\Session::get('dataFaseActual.0.'.$key)}}">


        @elseif($item['tipo'] == 'textarea')
          <div class="form-group">
            <div class="col-lg-4">
              <label for="{{ $key }}">{{ $item['nombre'] }}</label>
            </div>
            <div class="col-lg-6">
              <textarea name="{{ $key }}" class="form-control {{ $item['tipo'] }}"> {{\Session::get('dataFaseActual.0.'.$key)}} </textarea>
            </div>
          </div>  
        @elseif($item['tipo'] == 'select')
          @php ($temporal = \Session::get('dataFaseActual.0.'.$key ))
            <div class="form-group">
              <div class="col-lg-4">
                <label for="{{ $key }}">{{ $item['nombre'] }}</label>
              </div>
              <div class="col-lg-6">
                
                <select  class="form-control {{ $item['tipo'] }}" id="{{ $key }}" type="text" name="{{ $key }}" {{\Session::get('dataFaseActual.0.'.$key.'disabled' )}}>
                  <option value="" selected="">--- Seleccione una opcion ---</option>
                  @foreach($item['datos'] as $llave=>$opcion)
                    @if($temporal == $llave)                      
                      <option value="{{ $llave }}" selected="">{{ $opcion }}</option>
                    @else
                      <option value="{{ $llave }}" >{{ $opcion }}</option>  
                    @endif 
                  @endforeach
                </select>
              </div>
            </div>     
        @else
          <div class="form-group">
            <div class="col-lg-4">
              <label for="{{ $key }}">{{ $item['nombre'] }}</label>
            </div>
            <div class="col-lg-6">
              <input class="form-control {{ $item['tipo'] }}" type="text" 
              name="{{ $key }}" placeholder="Ingrese {{ lcfirst(mb_strtolower($item['nombre'])) }}" value="{{\Session::get('dataFaseActual.0.'.$key)}}" maxlength="{{ $item['long'] }}" 
              {{\Session::get('disabled')}}>
            </div>
          </div>
        @endif  
     
    @endforeach
      
    
      
      <div class="form-group">
        <div class="col-lg-9">
          <input id="envio" type="submit" value="Guardar" class="btn btn-info">
        </div>

      </div>
 
</form>

