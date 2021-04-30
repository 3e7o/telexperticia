<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Reporte General</title>
  <meta name="description" content="Description of your site goes here">
  <meta name="keywords" content="keyword1, keyword2, keyword3">
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
.section1 h3, .section4 h3 {
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
        <p>Fecha: <?php echo date("Y-m-d");?></p>
      </div>
    </div>
    <div class="sub-report">
        <p>En el siguiente documento se presenta información referente al Sistema de Informacion en Telexperticia hasta la fecha
            cubriendo los siguiente:
        </p>
            <p><strong>USUARIOS:</strong></p>
            <p>Se presentara el número de usuarios registrados en el sistema tanto medicos como pacientes: </p>
      <table width="100%" border="1">
              <tr>
                <td><div align="center"><strong>Usuario</strong></strong></div></td>
                <td><div>
                  <div align="center"><strong>Registrados</strong></div>
                </div></td>
              </tr>
              <tr>
                <td>Pacientes</td>
                <td><div align="center">{{$patients}}</div></td>
              </tr>
              <tr>
                <td>Médicos</td>
                <td><div align="center">{{$doctors}}</div></td>
              </tr>
            </table>

</div>
    <div class="sub-report">
            <p><strong>Juntas Médicas:</strong></p>
            <p>Se presentara el número de Juntas Médicas "Realizadas", "Programadas", "Canceladas" y "Expiradas": </p>
            <table width="100%" border="1">
              <tr>
                <td><div align="center"><strong>Estado de Junta Médica</strong></div></td>
                <td><div align="center"><strong>Cantidad</strong></div></td>
              </tr>
              <tr>
                <td>Realizadas</td>
                <td><div align="center">{{$jrealizadas}}</div></td>
              </tr>
              <tr>
                <td>Programadas</td>
                <td><div align="center">{{$jprogramado}}</div></td>
              </tr>
              <tr>
                <td>Canceladas</td>
                <td><div align="center">{{$jcancelado}}</div></td>
              </tr>
              <tr>
                <td>Expiradas</td>
                <td><div align="center">{{$jexpirado}}</div></td>
              </tr>
            </table>

    </div>

        <div class="sub-report">
            <p><strong>Informes de Juntas Médicas:</strong></p>
            <p>Se presentara el número de Informes "Aprobados" y "No Aprobados": </p>
            <table width="100%" border="1">
              <tr>
                <td><div align="center"><strong>Estado de Informe</strong></div></td>
                <td><div align="center"><strong>Cantidad</strong></div></td>
              </tr>
              <tr>
                <td>Aprobado</td>
                <td><div align="center">{{$aprobado}}</div></td>
              </tr>
              <tr>
                <td>No aprobado</td>
                <td><div align="center">{{$noaprobado}}</div></td>
              </tr>
            </table>

    	</div>

        <div class="sub-report">
            <p><strong>Juntas Médicas por Especialidad:</strong></p>
            <p>Se presentara el número de Juntas Médicas realizadas de acuerdo a la especialidad: </p>
            <table width="100%" border="1">
                    <thead>
                        <tr>
                            <th>Especialidad</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($especialidades as $especialidad => $label)
                        <tr>
                            <td>{{ $especialidad ?? '-' }}</td>
                            <td>{{ $label ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>

    	</div>



</body></html>
