<div class="horizontal-menu">
<!-- Logo - Usuario -->
  <nav class="navbar top-navbar">

    <div class="container">
      <div class="navbar-content">
        <a href="#" class="navbar-brand">
          COSSMIL
        </a><img src="{{ asset('logo.png') }}" alt="" width="60" height="60">

        <ul class="navbar-nav">

          <li class="nav-item dropdown nav-profile">
            <span class="navbar-text">
                {{ Auth::user()->name }}   .
            </span>
            <a class="feather feather-user" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-horizontal"></i>
            </a>

            <div class="dropdown-menu" aria-labelledby="profileDropdown">
              <div class="dropdown-header d-flex flex-column align-items-center">
                <div class="info text-center">
                  <p class="name font-weight-bold mb-0">{{ Auth::user()->name  }}</p>
                  <p class="email text-muted mb-3">{{ Auth::user()->email }}</p>
                </div>
              </div>

              <div class="dropdown-body">
                <ul class="profile-nav p-0 pt-3">
                  <li class="nav-item">
                    <i class="link-icon" data-feather="log-out"></i> <a class="nav-link"  href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                  </li>
                </ul>
              </div>
            </div>
          </li>
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
          <i data-feather="menu"></i>
        </button>
      </div>
    </div>
  </nav>
  <!-- Barra de navegacion  -->
  <nav class="bottom-navbar">
    <div class="container">
      <ul class="nav page-navigation">
@auth
{{-- <li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">Dashboard</a>
</li> --}}

@if (Auth::user()->can('view-any', Spatie\Permission\Models\MedicalBoard::class))

<li class="nav-item {{ active_class(['home']) }}">
    <a class="nav-link" href="{{ url('home') }}">
      <i class="link-icon" data-feather="calendar"></i>
      <span class="menu-title">Calendario</span>
    </a>
  </li>
  @endif


@if (Auth::user()->can('view-any', Spatie\Permission\Models\MedicalBoard::class) ||
    Auth::user()->can('view-any', Spatie\Permission\Models\Report::class))
        <li class="nav-item {{ active_class(['medical-boards', 'reports']) }}">
            <a href="#" class="nav-link">
              <i class="link-icon" data-feather="clipboard"></i>
              <span class="menu-title">Juntas Médicas</span>
              <i class="link-arrow"></i>
            </a>
            <div class="submenu">
              <ul class="submenu-item">
                @can('view-any', App\Models\MedicalBoard::class)
                <li class="category-heading">Programar Junta</li>
                @can('create', App\Models\MedicalBoard::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['medical-boards/crear']) }}" href="{{ route('medical-boards.create') }}">Nueva Médicas</a></li>
                @endcan
                <li class="nav-item"><a class="nav-link {{ active_class(['medical-boards']) }}" href="{{ route('medical-boards.index') }}">Juntas Médicas</a></li>
                @endcan
                @can('view-any', App\Models\MedicalBoard::class)
                <li class="category-heading">Lista de Informes<li>
                <li class="nav-item"><a class="nav-link {{ active_class(['reports']) }}" href="{{ route('reports.index') }}">Informes</a></li>
                @endcan
              </ul>
            </div>
          </li>
@endif

@if (Auth::user()->can('view-any', Spatie\Permission\Models\User::class) ||
    Auth::user()->can('view-any', Spatie\Permission\Models\Doctor::class) ||
    Auth::user()->can('view-any', Spatie\Permission\Models\Patient::class))
        <li class="nav-item {{ active_class(['users', 'doctors', 'patients']) }}">
          <a href="#" class="nav-link">
            <i class="link-icon" data-feather="users"></i>
            <span class="menu-title">Personal</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
                @can('view-any', App\Models\User::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['users']) }}" href="{{ route('users.index') }}">Usuarios</a></li>
                @endcan
                @can('view-any', App\Models\Doctor::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['doctors']) }}" href="{{ route('doctors.index') }}">Médicos</a></li>
                @endcan
                @can('view-any', App\Models\Patient::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['patients']) }}" href="{{ route('patients.index') }}">Pacientes</a></li>
                @endcan
            </ul>
          </div>
        </li>
@endif

@if (Auth::user()->can('view-any', Spatie\Permission\Models\Specialty::class) ||
    Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
        <li class="nav-item {{ active_class(['permissions', 'roles', 'specialties', 'zoom']) }}">
            <a href="#" class="nav-link">
              <i class="link-icon" data-feather="briefcase"></i>
              <span class="menu-title">Administración</span>
              <i class="link-arrow"></i>
            </a>
            <div class="submenu">
              <ul class="submenu-item">
                <li class="category-heading">Configuración<li>
                @can('view-any', App\Models\Specialty::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['specialties']) }}" href="{{ route('specialties.index') }}">Especialidades</a></li>
                @endcan
                @can('view-any', Spatie\Permission\Models\Role::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['zoom']) }}" href="{{ route('zoom') }}">API Zoom</a></li>
                @endcan
                @can('view-any', Spatie\Permission\Models\Role::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['stats']) }}" href="{{ route('stats') }}">Información del Sistema</a></li>
                @endcan
                @can('view-any', Spatie\Permission\Models\Role::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['activeLog']) }}" href="{{ route('activeLog') }}">Registro de Actividades</a></li>
                @endcan
                <li class="category-heading">Parametros<li>
                @can('view-any', Spatie\Permission\Models\Role::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['gparameters']) }}" href="{{ route('gparameters.index') }}">Grupos de Parametros</a></li>
                @endcan
                @can('view-any', Spatie\Permission\Models\Role::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['parameters']) }}" href="{{ route('parameters.index') }}">Contenido de Parametros</a></li>
                @endcan
                <li class="category-heading">Roles y permisos<li>
                @can('view-any', Spatie\Permission\Models\Role::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['roles']) }}" href="{{ route('roles.index') }}">Roles</a></li>
                @endcan
                @can('view-any', Spatie\Permission\Models\Permission::class)
                <li class="nav-item"><a class="nav-link {{ active_class(['permissions']) }}" href="{{ route('permissions.index') }}">Permisos</a></li>
                @endcan
              </ul>
            </div>
          </li>

@endif
@endauth
      </ul>
    </div>
  </nav>
</div>
