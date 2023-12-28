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
    <title>Psicológica {{ucwords($paciente->nombrePaciente.' '.$paciente->apellidoPaciente)}}</title>

    </head>



    <body>
        
        <div class="header">
            <div class="logo">
                <img src="{{url('/images/logo-512x512.jpg')}}" alt="logo" style="width: 60px">
            </div>
            <div class="title">
                <h1>Planilla Psicológica</h1>
            </div>
            <div class="info">
                Fecha: <strong>{{date("d-m-Y",strtotime($psychologicalSheet->created_at))}}</strong> <br>
                Paciente: <strong>{{ucwords($paciente->nombrePaciente.' '.$paciente->apellidoPaciente)}}</strong><br>
                Edad: <strong>{{$edad}}</strong>
            </div>

        </div>
        
        <div class="container">
            <div class="border" >
                <div class="card-header mb-2">
                    DATOS GENERALES
                </div>
                <table>
                    <tbody>
                        <tr>
                            <td >PESO: <strong>{{ucfirst($psychologicalSheet->peso)}}</strong></td>
                            <td >PESO MÁXIMO: <strong>{{ucfirst($psychologicalSheet->peso_maximo)}}</strong></td>
                            <td >EDAD: <strong>{{ucfirst($psychologicalSheet->edad)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">INTENCIÓN DE CIRUGÍA: <strong>{{ucfirst($psychologicalSheet->intencion_cirugia)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">ANTECEDENTES: <strong>{{ucfirst($psychologicalSheet->antecedentes)}}</strong></td>
                        </tr>   
                    </tbody>
                </table>
                <div class="card-header mb-2">
                    DATOS GENERALES
                </div>
                <table>
                    <tbody>
                        <tr>
                            <td colspan="3">TRATAMIENTO PSICOLÓGICO: <strong>{{ucfirst($psychologicalSheet->tto_psicologico)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">TRATAMIENTO PSIQUIÁTRICO: <strong>{{ucfirst($psychologicalSheet->tto_psiquiatrico)}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3">CONDUCTA ALIMENTARIA: <strong>{{ucfirst($psychologicalSheet->conducta_alimentaria)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">ATRACÓN: <strong>{{ucfirst($psychologicalSheet->atracon)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">COMEDOR NOCTURNO: <strong>{{ucfirst($psychologicalSheet->comedor_nocturno)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">ACTIVIDAD FÍSICA: <strong>{{ucfirst($psychologicalSheet->actividad_fisica)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">TRABAJO/OCUPACIÓN: <strong>{{ucfirst($psychologicalSheet->trabajo)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">FAMILIA: <strong>{{ucfirst($psychologicalSheet->familia)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">PÉRDIDAS/DUELOS: <strong>{{ucfirst($psychologicalSheet->perdidas)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">TRATAMIENTOS ANTERIORES: <strong>{{ucfirst($psychologicalSheet->tto_anteriores)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">LIMITACIONES: <strong>{{ucfirst($psychologicalSheet->limitaciones)}}</strong></td>
                        </tr> 
                        <tr>
                            <td colspan="3">EVOLUCIÓN: <strong>{{ucfirst($psychologicalSheet->evolucion)}}</strong></td>
                        </tr>   
                    </tbody>
                </table>
            </div>
        </div>  
        
    

    </body>


</html>