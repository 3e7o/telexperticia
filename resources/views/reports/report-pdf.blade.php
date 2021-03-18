<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe</title>
</head>
<style>
    body {
        margin-left: 30px;
        margin-right: 30px;
    }
    h1 {
        font-size: 18px;
    }
    h2 {
        font-size: 16px;
    }
    h2 {
        font-size: 14px;
    }
    .title, .sub-title {
        text-align: center;
    }
    .box-firms {
        margin-top: 50px;
    }
    .content {
        font-size: 16px;
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
    }
</style>
<body>
    <h1 class="title">Informe de Junta Médica N° {{ $medicalBoard->code }}</h1>
    <h2 class="sub-title">Fecha: {{ $medicalBoard->date->format('d/m/Y') }}</h2>

    <p>
        Paciente: {{ $patient->name }} {{ $patient->first_surname }} {{ $patient->last_surname }} <br>
        Cédula de Identidad: {{ $patient->ci }} <br>
        Matrícula: {{ $patient->matricula }} <br>
        <h4>El suscrito especialista del Hospital Militar Central <br> Informa: <br></h4>
    </p>

    <div class="sub-report">
        <h4>Antecedentes:</h4>
        <p>{{ $report->record }}</p>
    </div>

    <div class="sub-report">
        <h4>Evaluación:</h4>
        <p>{{ $report->evaluation }}</p>
    </div>

    <div class="sub-report">
        <h4>Diagnóstico:</h4>
        <p>{{ $report->diagnosis }}</p>
    </div>

    <div class="sub-report">
        <h4>Recomendaciones:</h4>
        <p>{{ $report->recommendations }}</p>
    </div>

    <div class="box-firms">
        <div class="left">
            <div class="content">
                <hr style="width: 60%">
                Médico Tratante Encargado <br>
                Dr.: {{ $doctorOwner->name }} {{ $doctorOwner->first_surname }} {{ $doctorOwner->last_surname }} <br>
                Especialidad: {{ $doctorOwner->specialty->name }} <br>
            </div>
        </div>
        <div class="right">
            <div class="content">
                @foreach($doctorsSupervisors as $doctor)
                    <div class="firm">
                        <hr style="width: 60%">
                        Médico Participante <br>
                        Dr.: {{ $doctor->name }} {{ $doctor->first_surname }} {{ $doctor->last_surname }} <br>
                        Especialidad: {{ $doctor->specialty->name }} <br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</body>
</html>
