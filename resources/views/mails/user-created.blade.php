<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Usuario Creado</title>
</head>
<body>
<p>Hola! estimado {{ $name }}.</p>
<p>Su usuario de tipo "{{ $userType }}" ha sido creado correctamente para el sistema de Telexperticia.</p>
<ul>
    <li>Ingreso: <a href="{{ Config::get('app.url')  }}/login">Click aquí</a></li>
    <li>Correo: {{ $email }}</li>
    <li>Contraseña: {{ $password }}</li>
</ul>
</body>
</html>
