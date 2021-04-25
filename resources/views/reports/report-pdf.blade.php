<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe</title>
<style type="text/css">
body,td,th {
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
    .title, .sub-title {
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
</style>
<body>
<div class="cabecera">
  <img src="{{ asset('logo.png') }}" alt="" width="50" height="50" align="left">
  <p>MINISTERIO DE DEFENSA</p>
  <p>COPORACIÓN DEL SEGURO SOCIAL MILITAR HOSPITAL MILITAR CENTRAL</p>
  <p>"LA PAZ - BOLIVIA"</p>
</div>
<div class="tituloInforme">
  <h1>INFORME DE JUNTA MÉDICA</h1>
  <p>SERV. MED. N° {{ $medicalBoard->code }}</p>
  <p>Fecha: {{ $medicalBoard->date->format('d/m/Y') }}</p>
</div>
<div class="inicio">
    <p>Paciente: {{ $patient->name }} {{ $patient->first_surname }} {{ $patient->last_surname }}</p>
    <p>Cédula de Identidad: {{ $patient->ci }}</p>
    <p>Matrícula: {{ $patient->matricula }}</p>

</div>
    <div class="sub-report">
   	  <p><strong>EL SUSCRITO ESPECIALISTA DEL HOSPITAL  MILITAR CENTRAL</strong></p>
        <p><strong>INFORMA:</strong></p>
        <h4>ANTECEDENTES:</h4>
        <p>{{ $report->record }}</p>
</div>

    <div class="sub-report">
      <h4>EVALUACIÓN:</h4>
        <p>{{ $report->evaluation }}</p>
    </div>

    <div class="sub-report">
        <h4>DIAGNÓSTICO:</h4>
        <p>{{ $report->diagnosis }}</p>
    </div>

    <div class="sub-report">
        <h4>RECOMENDACIONES:</h4>
        <p>{{ $report->recommendations }}</p>
    </div>

    <div class="box-firms">
      <div class="center">
            <div class="content">
                <img src="{{ url('assets/images/placeholder.jpg') }}" alt="..." width="150" height="50" class="card-img-top">
                <hr style="width: 40%">
                Médico Tratante Encargado <br>
                Dr.: {{ $doctorOwner->name }} {{ $doctorOwner->first_surname }} {{ $doctorOwner->last_surname }} <br>
                Especialidad: {{ $doctorOwner->specialty->name }} <br>
            </div>
        </div>
    </div>

    <table id="dataTableExample" class="table dataTable no-footer" role="grid" aria-describedby="dataTableExample_info">
        <tbody>
            @php $i=0; @endphp
            @for ($i; $i <=count($doctorsSupervisors); $i++)

            <tr>
                    <td>
                        <div class="content">
                            <div class="firm">
                                    <img src="{{ url('assets/images/placeholder.jpg') }}" alt="..." width="150" height="50" class="card-img-top">
                                    <hr style="width: 90%">
                                    Médico Participante <br>
                                    Dr.: {{ $doctorsSupervisors[$i]->name }} {{ $doctorsSupervisors[0]->first_surname }} {{ $doctorsSupervisors[$i]->last_surname }} <br>
                                    Especialidad: {{ $doctorsSupervisors[$i]->specialty->name }} <br>
                                    @php $i++; @endphp
                            </div>
                        </div>
                    </td>
                <td>
                    <div class="content">
                        <div class="firm">
                                @isset($doctorsSupervisors[$i])
                                <img src="{{ url('assets/images/placeholder.jpg') }}" alt="..." width="150" height="50" class="card-img-top">
                                <hr style="width: 90%">
                                Médico Participante <br>
                                Dr.: {{ $doctorsSupervisors[$i]->name }} {{ $doctorsSupervisors[$i]->first_surname }} {{ $doctorsSupervisors[$i]->last_surname }} <br>
                                Especialidad: {{ $doctorsSupervisors[$i]->specialty->name }} <br>
                                @endisset
                        </div>
                  </div>
                </td>

            </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>
