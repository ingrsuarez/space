<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <style>

            .header{
                position: relative;
                height: 100px;
                border-bottom: 2px solid #222;
                margin-bottom: 40px;
            }

            .logo{
                position: absolute;
                top: 0.2cm;
                left: 0.2cm;
                width: 80px;
                /* border: 1px solid rgb(198, 173, 230); */
            }

            .title{
                position: absolute;
                top: 0.3cm;
                left: 20%;
                text-align: center;
                width: 300px;
                /* border: 1px solid lightblue; */
            }

            .info{
                position: absolute;
                right: 0.4cm;
                top: 0.2cm;
                text-align: right;
                /* border: 1px solid lightcoral; */
                width: 250px;
                
            }
            .strong{
                font-weight: bold;
            }

            .container{
                position: relative;
                display: flex;
                /* border: 2px solid #771; */
                margin-top: 2px;
                /* margin-left: 1cm; */
            }
            .item{
                width: 20%;
                padding: 10px;
                border: 2px solid #444;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                padding: 8px;
                text-align: left;
                border-bottom: 1px solid #DDD;
            }
            /* table{
                border-collapse: separate;
                border-spacing: 0px 20px;
            } */
            th{
                background-color: #D6EEEE;
                border-top: 1px solid #111;
                border-bottom: 1px solid #111;
                box-shadow: #444;
            }
            table tr{
                height:200px;
                border-bottom: 1px solid #ddd;
            }
            
            tr:nth-child(even) {
                background-color: #ececec;
            }



        </style>
    <title>Clinica {{ucwords($paciente->nombrePaciente.' '.$paciente->apellidoPaciente)}}</title>

    </head>



    <body>
        
        <div class="header">
            <div class="logo">
                <img src="{{url('/images/logo-512x512.jpg')}}" alt="logo" style="width: 60px">
            </div>
            <div class="title">
                <h1>Planilla Clínica</h1>
            </div>
            <div class="info">
                Fecha: <strong>{{date("d-m-Y",strtotime($clinicalSheet->created_at))}}</strong> <br>
                Paciente: <strong>{{ucwords($paciente->nombrePaciente.' '.$paciente->apellidoPaciente)}}</strong><br>
                Peso: <strong>{{$clinicalSheet->peso}}</strong>
            </div>

        </div>
       
        <div class="container">
            
            {{-- @foreach($clinicalSheet->getAttributes() as $key => $value)
                @if($key != 'id' and $key != 'user_id' and $key != 'institution_id' and $key != 'paciente_id') 
                <td>
                    {{ucfirst($key).': '}}
                    <strong>{{ucfirst($value)}}</strong>
                </td>  
                @endif
            @endforeach --}}
            
            <table class="data" style="width:100%">
                <thead >
                    <th>Parámetro</th>
                    <th style="width:40%">Valor</th>
                    <th>Parámetro</th>
                    <th style="width:40%">Valor</th>
                </thead>
                <tbody>
                    @php $i = 0; @endphp

                    @foreach($clinicalSheet->getAttributes() as $key => $value)

                        @if($key != 'id' and $key != 'user_id' and $key != 'institution_id' and $key != 'paciente_id' and $key != 'created_at' and $key != 'updated_at')
                            @if($i % 2 == 0)
                            <tr style="height:200px">
                                <td><strong>{{ucfirst(str_replace("_"," ",$key)).': '}}</strong></td>
                                <td style="widht: 40%">{{ucfirst($value)}}</td>
                               
                            @else
                                <td><strong>{{ucfirst(str_replace("_"," ",$key)).': '}}</strong></td>
                                <td>{{ucfirst($value)}}</td>
                            </tr>
                            
                            @endif
                            
                        @endif
                        @php $i += 1; @endphp
                    @endforeach

                </tbody>
                

            </table>
        </div>
    

    </body>


</html>