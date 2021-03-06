<?php

return [
    'common' => [
        'actions' => 'Acciones',
        'create' => 'Crear',
        'date' => 'Fecha Creación',
        'edit' => 'Editar',
        'update' => 'Actualizar',
        'search' => 'Buscar...',
        'back' => 'Regresar al listado',
        'are_you_sure' => '¿Esta seguro?',
        'no_items_found' => 'Sin registros',
        'created' => 'Creado satisfactoriamente',
        'saved' => 'Actualizado satisfactoriamente',
        'removed' => 'Eliminado satisfactoriamente',
    ],

    'especialidades' => [
        'name' => 'Especialidades',

        'index_title' => 'Lista de Especialidades',
        'create_title' => 'Crear Especialidad',
        'edit_title' => 'Editar Especialidad',
        'show_title' => 'Mostrar Especialidad',
        'inputs' => [
            'name' => 'Especialidad',
            'date' => 'Fecha Creación',
        ],
    ],
    'parametros' => [
        'name' => 'Parametros',

        'index_title' => 'Lista de Parametros',
        'create_title' => 'Crear Parametros',
        'edit_title' => 'Editar Parametros',
        'show_title' => 'Mostrar Parametros',
        'inputs' => [
            'name' => 'Parametros',
            'date' => 'Fecha Creación',
            'description' => 'Descripción',
        ],
    ],
    'gparametros' => [
        'name' => 'Grupo de Parametros',

        'index_title' => 'Lista de Grupo Parametros',
        'create_title' => 'Crear Grupo de Parametros',
        'edit_title' => 'Editar Grupo de Parametros',
        'show_title' => 'Mostrar Grupo de Parametros',
        'inputs' => [
            'name' => 'Parametros',
            'date' => 'Fecha Creación',
            'description' => 'Descripción',
        ],
    ],

    'antecedentes' => [
        'name' => 'Antecedentes',

        'index_title' => 'Lista de Antecedentes',
        'create_title' => 'Crear Antecedente',
        'edit_title' => 'Editar Antecedente',
        'show_title' => 'Mostrar Antecedente',
        'inputs' => [
            'name' => 'Antecedente',
            'date' => 'Fecha Creación',
            'description' => 'Descripción',
        ],
    ],

    'doctores' => [
        'name' => '',
        'index_title' => 'Lista de Médicos',
        'create_title' => 'Crear Médico',
        'edit_title' => 'Editar Médico',
        'date' => 'Fecha Creación',
        'show_title' => 'Ver Médico',
        'inputs' => [
            'ci' => 'Cédula de Identidad',
            'name' => 'Nombres',
            'first_surname' => 'Apellido Paterno',
            'last_surname' => 'Apellido Materno',
            'email' => 'Email',
            'phone' => 'Teléfono',
            'specialty_id' => 'Especialidad',
        ],
    ],

    'pacientes' => [
        'name' => 'Pacientes',
        'index_title' => 'Lista de Pacientes',
        'create_title' => 'Crear Paciente',
        'edit_title' => 'Editar Paciente',
        'date' => 'Fecha Creación',
        'show_title' => 'Ver Paciente',
        'inputs' => [
            'ci' => 'Cédula de Identidad',
            'name' => 'Nombre',
            'first_surname' => 'Apellido Paterno',
            'last_surname' => 'Apellido Materno',
            'email' => 'Email',
            'force' => 'Fuerza',
            'birthday' => 'Fecha de Nacimiento',
            'gender' => 'Género',
            'address' => 'Dirección',
        ],
    ],

    'juntas_medicas' => [
        'name' => 'Juntas Médicas',
        'index_title' => 'Listado de Juntas Médicas',
        'create_title' => 'Crear Junta Médica',
        'edit_title' => 'Editar Junta Médica',
        'date' => 'Fecha Creación',
        'show_title' => 'Ver Junta Médica',
        'inputs' => [
            'date' => 'Fecha',
            'patient_id' => 'Paciente',
            'status' => 'Estado',
        ],
    ],

    'informes' => [
        'name' => 'Informes',
        'index_title' => 'Lista de Informes',
        'create_title' => 'Crear Informe',
        'edit_title' => 'Editar Informe',
        'date' => 'Fecha Creación',
        'show_title' => 'Ver Informe',
        'inputs' => [
            'medical_board_id' => 'Junta Médica',
            'record' => 'Antecedentes',
            'evaluation' => 'Evaluación',
            'diagnosis' => 'Diagnóstico',
            'recommendations' => 'Recomendaciones',
        ],
    ],

    'usuarios' => [
        'name' => 'Usuarios',
        'index_title' => 'Lista de Usuarios',
        'create_title' => 'Crear Usuario',
        'edit_title' => 'Editar Usuario',
        'show_title' => 'Ver Usuario',
        'date' => 'Fecha Creación',
        'update' => 'Fecha Modificación',
        'inputs' => [
            'name' => 'Nombre',
            'username'=> 'Usuario',
            'rol'=> 'Rol',
            'email' => 'Email',
            'password' => 'Contraseña',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Lista de Roles',
        'create_title' => 'Crear Rol',
        'edit_title' => 'Editar Rol',
        'date' => 'Fecha Creación',
        'update' => 'Fecha Modificación',
        'show_title' => 'Ver Rol',
        'inputs' => [
            'name' => 'Nombre',
        ],
    ],

    'permissions' => [
        'name' => 'Permisos',
        'index_title' => 'Lista de Permisos',
        'create_title' => 'Crear Permiso',
        'edit_title' => 'Editar Permiso',
        'show_title' => 'Mostrar Permiso',
        'update' => 'Fecha Modificación',
        'date' => 'Fecha Creación',
        'inputs' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
        ],
    ],
];
