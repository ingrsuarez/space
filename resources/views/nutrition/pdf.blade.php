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

            .border {
                /* border: solid 1px #444;
                border-radius: 3px;
                box-sizing: border-box;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; */
                margin-bottom: 20px;
            }
            .card-header {
                border-radius: 3px;
                background-color: #04aa6d;
                padding: 0.5rem;
                color:rgb(255, 255, 255);
            }

            .card-body{
                padding: 8px;
            }

            .square{
                border-bottom: 1px solid #999;
                background-color: #ececec;
                padding: 4px;
                margin-bottom: 1rem;
            }

            .square-white{
                border: none;
                background-color: #fff;
                padding: 4px;
            }

            .cell{
                margin-left: 2rem;
                margin-right: 1rem;
                border-right: 1px solid #999;
            }


        </style>
    <title>Nutrición {{ucwords($paciente->nombrePaciente.' '.$paciente->apellidoPaciente)}}</title>

    </head>



    <body>
        
        <div class="header">
            <div class="logo">
                <img src="{{url('/images/logo-512x512.jpg')}}" alt="logo" style="width: 60px">
            </div>
            <div class="title">
                <h1>Planilla Nutricional</h1>
            </div>
            <div class="info">
                Fecha: <strong>{{date("d-m-Y",strtotime($nutritionSheet->created_at))}}</strong> <br>
                Paciente: <strong>{{ucwords($paciente->nombrePaciente.' '.$paciente->apellidoPaciente)}}</strong><br>
                Peso: <strong>{{$nutritionSheet->peso}}</strong>
            </div>

        </div>
       
        <div class="container">
            <div class="border" >
                <div class="card-header">
                    VALORACIÓN NUTRICIONAL
                </div>
                <table>
                    <tbody>
                        <tr>
                            <td >EDAD: <strong>{{$nutritionSheet->edad}}</strong></td>
                            <td >CONTROL: <strong>{{ucfirst($nutritionSheet->control)}}</strong></td>
                            <td >FUMA: <strong>{{ucfirst($nutritionSheet->fuma)}}</strong></td>
                        </tr>
                        <tr>
                            <td >ACTIVIDAD: <strong>{{ucfirst($nutritionSheet->actividad)}}</strong></td>
                            <td >TIPO: <strong>{{ucfirst($nutritionSheet->tipo_actividad)}}</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td >FRECUENCIA: <strong>{{ucfirst($nutritionSheet->frecuencia_actividad)}}</strong></td>
                            <td >DURACIÓN: <strong>{{ucfirst($nutritionSheet->duracion_actividad)}}</strong></td>
                            <td></td>
                        </tr>   
                        <tr>
                            <td >PESO: <strong>{{$nutritionSheet->peso}}</strong></td>
                            <td >ALTURA: <strong>{{ucfirst($nutritionSheet->altura)}}</strong></td>
                            <td >PESO IDEAL: <strong>{{ucfirst($nutritionSheet->peso_ideal)}}</strong></td>
                        </tr>
                        <tr>
                            <td >IMC: <strong>{{$nutritionSheet->imc}}</strong></td>
                            <td >HORAS DE SUEÑO: <strong>{{ucfirst($nutritionSheet->horas_suenio)}}</strong></td>
                            <td >OCUPACIÓN: <strong>{{ucfirst($nutritionSheet->ocupacion)}}</strong></td>
                        </tr>
                        <tr>
                            <td >JORNADA: <strong>{{$nutritionSheet->jornada}}</strong></td>
                            <td >CX BARIÁTRICA: <strong>{{ucfirst($nutritionSheet->bariatrica)}}</strong></td>
                            <td ></td>
                        </tr>
                        <tr>
                            <td >CIRC. CUELLO: <strong>{{$nutritionSheet->cuello}}</strong></td>
                            <td >CIRC. CINTURA: <strong>{{ucfirst($nutritionSheet->cintura)}}</strong></td>
                            <td></td>
                        </tr>

                    </tbody>


                </table>
            </div>
            <div class="border" >
                <div class="card-header">
                    ANAMNESIS ALIMENTARIA
                </div>
                <table>
                    <tbody>
                        <tr>
                            <td >COLACIONES: <strong>{{ucfirst($nutritionSheet->colaciones)}}</strong></td>
                            <td >DESAYUNO: <strong>{{$nutritionSheet->desayuno}}</strong></td>
                            <td >ALMUERZO: <strong>{{ucfirst($nutritionSheet->almuerzo)}}</strong></td>        
                        </tr>
                        <tr>
                            <td >MERIENDA: <strong>{{ucfirst($nutritionSheet->merienda)}}</strong></td>
                            <td >CENA: <strong>{{$nutritionSheet->cena}}</strong></td>
                            <td >NO INGIERE: <strong>{{ucfirst($nutritionSheet->no_ingiere)}}</strong></td>        
                        </tr>
                        <tr>
                            <td >PREDILECTOS: <strong>{{ucfirst($nutritionSheet->predilectos)}}</strong></td>
                            <td >INTOLERANCIAS ALERGIAS: <strong>{{$nutritionSheet->intolerancias_alergias}}</strong></td>
                            <td >ALCOHOL: <strong>{{ucfirst($nutritionSheet->alcohol)}}</strong></td>        
                        </tr>
                        <tr>
                            <td colspan="3">OBSERVACIONES: <strong>{{ucfirst($nutritionSheet->observaciones)}}</strong></td>       
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="border" >
                <div class="card-header">
                    DIAGNOSTICO NUTRICIONAL (PROBLEMA/ ETILOGÍA/ SINTOMA)
                </div>
                <table>
                    <tbody>
                        <tr>
                            <td colspan="3">COLACIONES: <strong>{{ucfirst($nutritionSheet->diagnostico_nutricional)}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="border" >
                <div class="card-header">
                    INTERVENCION NUTRICIONAL
                </div>
                <table>
                    <tbody>
                        <tr>
                            <td colspan="3">INDICACIÓN NUTRICIONAL: <strong>{{ucfirst($nutritionSheet->indicacion_nutricional)}}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <th colspan="3">METAS:</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">META 1: <strong>{{ucfirst($nutritionSheet->meta_uno)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">META 2: <strong>{{ucfirst($nutritionSheet->meta_dos)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">META 3: <strong>{{ucfirst($nutritionSheet->meta_tres)}}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <th colspan="3">VTC - - - ></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">GR HDC: <strong>{{ucfirst($nutritionSheet->gr_hdc)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">GR PROT.: <strong>{{ucfirst($nutritionSheet->gr_prot)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">GR GRASAS: <strong>{{ucfirst($nutritionSheet->gr_grasas)}}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <th colspan="3">SISTEMA DE PAUTA ALIMENTARIA</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">CUALITATIVO: <strong>{{ucfirst($nutritionSheet->pauta_cualitativo)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">CUANTITATIVO: <strong>{{ucfirst($nutritionSheet->pauta_cuantitativo)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">OBSERVACIONES: <strong>{{ucfirst($nutritionSheet->pauta_observaciones)}}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-header">
                    SEGUIMIENTO
                </div>
                <table>
                    <tbody>
                        <tr>
                            <td colspan="3">PESO INICIAL: <strong>{{ucfirst($nutritionSheet->peso_inicial)}}</strong></td>
                            <td colspan="3">PESO IDEAL AJUSTADO: <strong>{{ucfirst($nutritionSheet->peso_ajustado)}}</strong></td>
                            <td colspan="3">IMC INICIAL: <strong>{{ucfirst($nutritionSheet->imc_inicial)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">% IMC PERDIDO: <strong>{{ucfirst($nutritionSheet->imc_perdido)}}</strong></td>
                            <td colspan="3">% EXCESO DE PESO PERDIDO: <strong>{{ucfirst($nutritionSheet->peso_perdido)}}</strong></td>
                            <td colspan="3">% EXCESO DE IMC PERDIDO: <strong>{{ucfirst($nutritionSheet->exceso_imc_perdido)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">% MASA GRASA: <strong>{{ucfirst($nutritionSheet->masa_grasa)}}</strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>  



            {{-- @foreach($nutritionSheet->getAttributes() as $key => $value)
                @if($key != 'id' and $key != 'user_id' and $key != 'institution_id' and $key != 'paciente_id') 
                <td>
                    {{ucfirst($key).': '}}
                    <strong>{{ucfirst($value)}}</strong>
                </td>  
                @endif
            @endforeach --}}
            
            {{-- <table class="data" style="width:100%">
                <thead >
                    <th>Parámetro</th>
                    <th style="width:40%">Valor</th>
                    <th>Parámetro</th>
                    <th style="width:40%">Valor</th>
                </thead>
                <tbody>
                    @php $i = 0; @endphp

                    @foreach($nutritionSheet->getAttributes() as $key => $value)

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
                

            </table> --}}
        
    

    </body>


</html>