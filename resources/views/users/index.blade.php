@extends('cache.index')

@section('page_heading','Utenti')
@section('body')


@role((['admin', 'gestoremultiplo' , 'superuser']))
    {{ Form::open(array('url' => '/users', 'action'=>'index' , 'method' => 'get')) }}
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {{ Form::label('societa_id', 'Azienda:') }}
                {{ Form::select('societa_id', $societa, $societa_id,['class' => 'form-control']) }}
            </div>
        </div>
    </div>
    {{Form::close()}}

@endrole



    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped">

                <thead>  <tr>
                    <th>Cognome</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Avanzamento formazione</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>


                @foreach($data as $dip)

                    <tr>
                        <td>{{ $dip->cognome }}</td>
                        <td>{{ $dip->nome }}</td>
                        <td>{{ $dip->email }}</td>

                        <td>

                            <div class="progress">
                                <div class="progress-bar"
                                     role="progressbar"
                                     aria-valuenow="{{$dip->_avanzamento_formazione->count() }}"
                                     aria-valuemin="0"
                                     aria-valuemax="{{$dip->_registro_formazione->count() }}"
                                     style="width: {{ round($dip->_avanzamento_formazione->count()/$dip->_registro_formazione->count()*100) }}%;">
                                    {{ round($dip->_avanzamento_formazione->count()/$dip->_registro_formazione->count()*100) . '%' }}
                                </div>
                            </div>

                        </td>

                        <td>
                            @role(['admin', 'superuser', 'gestoremultiplo', 'azienda' ])
                            <a class="btn btn-warning btn-xs" href="users/{{$dip->id}}/edit" title="modfica"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-warning btn-xs" href="usersformazione/{{$dip->id}}" title="formazione"><i class="fa fa-mortar-board"></i></a>
                            @endrole
                        </td>
                    </tr>

                @endforeach

                </tbody>


            </table>
        </div>
    </div>
@stop


@section('script')
    <script type="text/javascript">

        $('#societa_id').on('change', function(e){
            $(this).closest('form').submit();
        });

    </script>

@stop

