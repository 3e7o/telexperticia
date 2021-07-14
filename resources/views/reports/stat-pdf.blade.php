<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reporte General</title>
    <meta name="description" content="Description of your site goes here">
    <meta name="keywords" content="keyword1, keyword2, keyword3">
    <style type="text/css">
        body,
        td,
        th {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12pt;
        }

    </style>
</head>
<style>
    body {
        margin-left: 30px;
        margin-right: 30px;
        font-size: 12pt;
        word-spacing: 2%;
    }

    h1 {
        font-size: 12pt;
        line-height: normal;
    }

    h2 {
        font-size: 16px;
    }

    h2 {
        font-size: 10pt;
        font-weight: bold;
    }

    .title,
    .sub-title {
        text-align: center;
        font-size: 10pt;
    }

    .box-firms {
        margin-top: 50px;
    }

    .box-firms-full {
        margin-top: 50px;
    }

    .content {
        font-size: 11pt;
        line-height: 20px;
        padding: 0 20px;
        text-align: center;
    }

    .left {
        float: left;
        width: 50%;
    }

    .right {
        float: right;
        width: 50%;
    }

    .firm {
        margin-bottom: 50px;
        font-size: 12pt;
    }

    .cabecera {
        font-weight: bold;
        font-size: 9pt;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        border-bottom-style: dotted;
        line-height: 2%;
    }

    .tituloInforme {
        font-weight: bold;
        font-size: 12pt;
        text-align: center;
        line-height: 2%;
    }

    .inicio {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12pt;
        line-height: 10%;
        border-bottom-style: solid;
    }

    .sections {
        width: 100%;
        float: left;
        padding-top: 41px;
    }

    .section1 {
        font-size: 11px;
        background-image: url(../images/sec1bg.jpg);
        background-repeat: no-repeat;
        background-position: left top;
        width: 171px;
        height: 111px;
        float: left;
        padding: 18px;
        margin-left: 10px;
    }

    .section1 h3,
    .section4 h3 {
        font-size: 14px;
    }

    .section2 {
        font-size: 11px;
        background-image: url(../images/sec2bg.jpg);
        background-repeat: no-repeat;
        background-position: left top;
        width: 171px;
        height: 111px;
        float: left;
        padding: 18px;
        margin-left: 17px;
    }

    .section2 h3 {
        font-size: 14px;
        color: #1f5aa0;
    }

</style>
</head>

<body>
    <div class="cabecera">
        <img src="{{ asset('logo.png') }}" alt="" width="50" height="50" align="left">
        <p>MINISTERIO DE DEFENSA</p>
        <p>COPORACIÓN DEL SEGURO SOCIAL MILITAR HOSPITAL MILITAR CENTRAL</p>
        <p>"LA PAZ - BOLIVIA"</p>
    </div>
    <div class="tituloInforme">
        <h1>REPORTE DE SISTEMA DE TELEXPERTICIA</h1>
        @if (empty($filter_start_date))
        <p>Fecha: <?php echo date('Y-m-d'); ?></p>
        @else
        <p>Fecha de: {{ $filter_start_date. ' hasta ' .$filter_end_date }}</p>
        @endif
        
    </div>
    </div>
    <div class="sub-report">
        <p>El siguiente documento cuenta con información representada en tablas y datos, referente al Sistema en
            Telexperticia hasta la fecha cubriendo los siguientes aspectos:</p>
        <p><strong>Número de Juntas Médicas:</strong></p>
        <p>A continuación, se presenta información referente a las Juntas Médicas : </p>
        <table width="100%" border="1">
            <tr>
                <td>
                    <div align="center"><strong>Juntas Médicas</strong></strong></div>
                </td>
                <td>
                    <div align="center"><strong>Cantidad</strong></strong></div>
                </td>
            </tr>
            <tr>
                <td>Realizadas</td>
                <td>
                    <div align="center">{{ $jrealizadas }}</div>
                </td>
            </tr>
            <tr>
                <td>Programadas</td>
                <td>
                    <div align="center">{{ $jprogramado }}</div>
                </td>
            </tr>
            <tr>
                <td>Canceladas</td>
                <td>
                    <div align="center">{{ $jcancelado }}</div>
                </td>
            </tr>
            <tr>
                <td>Reprogramar</td>
                <td>
                    <div align="center">{{ $jexpirado }}</div>
                </td>
            </tr>
            <tr>
                @php
                    $sum = $jrealizadas + $jprogramado + $jcancelado + $jexpirado;
                @endphp
                <td>Total</td>
                <td>
                    <div align="center">{{ $sum }}</div>
                </td>
            </tr>
        </table>
        
        <div align="center"><img
                src="https://quickchart.io/chart?c={type:'bar',data:{labels:['Realizadas','Programadas','Canceladas','Reprogramar'],datasets:[{label:'Dataset1',data:[{{ $jrealizadas }},{{ $jprogramado }},{{ $jcancelado }},{{ $jexpirado }}],}],},options:{legend:{display:false,},scales:{xAxes:[{display:true,gridLines:{display:true,},}],yAxes:[{display:true,gridLines:{display:true,},}]},},}"
                height="250" width="500"><p>Gráfico de Juntas Médicas</p></div>
    </div>

    <div class="sub-report">
      <p><strong>Juntas Médicas por Regional:</strong></p>
      <p>Se presenta información sobre la regional y la cantidad de Juntas Médicas</p>
      <table width="100%" border="1">
        <thead>
            <tr>
                <th><div align="center">Regional</div></th>
                <th><div align="center">Número de Juntas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regionales as $regional => $label)
                <tr>
                    <td>{{ $regional ?? '-' }}</td>
                    <td><div align="center">{{ $label ?? '-' }}</div></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="page-break-after:always;"></div>
      <div align="center"><img
              src="https://quickchart.io/chart?c={ type: 'pie', data: { datasets: [ { data: [{{ $reg_val }}], backgroundColor: [ 'rgb(255, 99, 132)', 'rgb(255, 159, 64)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(54, 162, 235)', ], label: 'Dataset 1', }, ], labels: ['{{ $reg_keys }}'], }, }"
              height="250" width="500"><p>Gráfico de Juntas Médicas por regional</p></div>

  </div>

    <div class="sub-report">
        <p><strong>Número de Juntas Médicas por Especialidad:</strong></p>

        <table width="100%" border="1">
          <thead>
              <tr>
                  <th><div align="center">Especialidad</div></th>
                  <th><div align="center">Número de Juntas</div></th>
              </tr>
          </thead>
          <tbody>
            @foreach ($especialidades as $especialidad => $label)
            <tr>
                <td>{{ $especialidad ?? '-' }}</td>
                <td><div align="center">{{ $label ?? '-' }}</div></td>
            </tr>
            @endforeach
          </tbody>
      </table>
      <div align="center"><img
        src="https://quickchart.io/chart?c={type:'bar',data:{labels:['{{ $esp_keys }}'],datasets:[{label:'Dataset1',data:[{{ $esp_val }}],}],},options:{legend:{display:false,},scales:{xAxes:[{display:true,gridLines:{display:true,},}],yAxes:[{display:true,gridLines:{display:true,},}]},},}"
        height="300" width="500"><p>Gráfico de Juntas Médicas por especialidad</p></div>
    </div>
    
    <div class="sub-report">
      <p><strong>Número de Juntas Médicas por Médico Encargado:</strong></p>
      <p>Se presentara el número de Juntas Médicas realizadas por médico encargado: </p>
      <table width="100%" border="1">
          <thead>
              <tr>
                <th><div align="center">Médico Encargado</div></th>
                <th><div align="center">Número de Juntas</div></th>
              </tr>
          </thead>
          <tbody>
            @foreach ($medico_numero as $medico_num => $label)
            <tr>
                <td>{{ $medico_num ?? '-' }}</td>
                <td><div align="center">{{ $label ?? '-' }}</div></td>
            </tr>
            @endforeach
          </tbody>
      </table>

  </div>

  <div class="sub-report">
    <p><strong>Número de Juntas Médicas por pacientes:</strong></p>
    <p>Se presentara el número de Juntas Médicas realizadas por paciente asegurado: </p>
    <table width="100%" border="1">
      <thead>
        <tr>
            <th><div align="center">Paciente</div></th>
            <th><div align="center">Cantidad</div></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($paciente_conts as $paciente_cont => $label)
        <tr>
            <td>{{ $paciente_cont ?? '-' }}</td>
            <td><div align="center">{{ $label ?? '-' }}</div></td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <div align="center"><img
      src="https://quickchart.io/chart?c={ type: 'pie', data: { datasets: [ { data: [{{ $gen_val }}], backgroundColor: [ 'rgb(156, 173, 177)', 'rgb(120, 137, 254)', 'rgb(222, 234, 246)', 'rgb(75, 192, 192)', 'rgb(54, 162, 235)', ], label: 'Dataset 1', }, ], labels: ['{{ $gen_keys }}'], }, }"
      height="300" width="500"><p>Gráfico de pacientes por género</p></div>
</div>

<div class="sub-report">
  <p><strong>Número informes aprobados y no aprobados:</strong></p>
  <p>Información referente sobre los informes de Juntas Médicas "Aprobadas" y "No aprobadas" </p>
  <div align="center"><img
    src="https://quickchart.io/chart?c={ type: 'doughnut', data: { datasets: [ { data: [{{ $aprobado }},{{ $noaprobado }}], backgroundColor: [ 'rgb(187, 143, 206)', 'rgb(133, 193, 233)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(54, 162, 235)', ], label: 'Dataset 1', }, ], labels: ['Aprobados','No aprobados'], }, }"
    height="300" width="500"><p>Gráfico de Juntas Médicas aprobadas y no aprobadas</p></div>
</div>

    <div class="sub-report">
        <p><strong>Relacion de Juntas Médicas por médico encargado y paciente</strong></p>
        <p>Se presentara la relacion de médicos encargados, regional y el paciente atendido</p>
        <table width="100%" border="1">
          <thead>
            <tr>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Regional</th>
                <th>Matricula</th>
                <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($doctor_pacientes as $doctor_paciente)
            <tr>
                <td>{{ $doctor_paciente->first_surname . ' ' . $doctor_paciente->last_surname ?? '-' }}
                </td>
                <td>{{ $doctor_paciente->name ?? '-' }}</td>
                <td>{{ $doctor_paciente->regional ?? '-' }}</td>
                <td>{{ $doctor_paciente->mat_beneficiario ?? '-' }}</td>
                <td>{{ $doctor_paciente->status ?? '-' }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

    </div>


</body>

</html>
