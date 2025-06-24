@extends('sources-dashboard')

@section('title')

<title>LearnX | Estadisticas usuarios</title>

@endsection

@section('content')

<!--Backup-->
<div class="col-md-4 mb-5">
  <div class="card">
    <div class="card-body text-center">
      <h4>Usuarios por rol<h4>
        <div>
          <canvas id="chart1"></canvas>
        </div>
      </div>
    </div>
</div>

<div class="col-md-8">
  <div class="card">
    <div class="card-body text-center">
      <h4>Usuarios registrados este mes<h4>

        @if($profesores_mes->count() != 0 || $estudiantes_mes->count() != 0)

        <div class="d-flex justify-content-center align-items-center" style="height: 249px;">
          <canvas id="chart2"></canvas>
        </div>

        @else
        <h5 class="text-muted">No hay usuarios registrados este mes</h5>
        @endif

      </div>
    </div>
</div>

@endsection

@section('script')

<script>
  const ctx = document.getElementById('chart1').getContext('2d');

  const myChart = new Chart(ctx, {
    type: 'doughnut', // Tipo de gráfica (donut)
    data: {
      labels: ['Administradores', 'Profesores', 'Estudiantes'],
      datasets: [{
        label: 'Usuarios',
        data: [{{ $admins->count() }}, {{ $profesores->count() }}, {{ $estudiantes->count() }}],
        backgroundColor: [
    'rgba(51, 102, 255, 0.6)', // Azul brillante
    'rgba(102, 51, 153, 0.6)', // Morado oscuro
    'rgba(204, 51, 153, 0.6)' // Rosado oscuro
    ],
        borderColor: [
    'rgba(51, 102, 255, 1)', // Azul brillante
    'rgba(102, 51, 153, 1)', // Morado oscuro
    'rgba(204, 51, 153, 1)' // Rosado oscuro
    ],
        borderWidth: 1
      }]
    },
    options: {
    // Puedes agregar aquí opciones para personalizar el aspecto de la gráfica
    }
  });

  const ctx2 = document.getElementById('chart2').getContext('2d');
  const myChart2 = new Chart(ctx2, {
      type: 'doughnut', // Tipo de gráfica (donut)
      data: {
      labels: ['Estudiantes', 'Profesores'],
      datasets: [{
      label: 'Usuarios Registrados Este Mes',
      data: [{{ $estudiantes_mes->count() }}, {{ $profesores_mes->count() }}],
      backgroundColor: [
      'rgba(144, 238, 144, 0.6)', // Verde menta claro
      'rgba(255, 165, 0, 0.6)' // Naranja claro
      ],
      borderColor: [
      'rgba(144, 238, 144, 1)', // Verde menta claro
      'rgba(255, 165, 0, 1)' // Naranja claro
      ],
      borderWidth: 1
      }]
      },
      options: {
      // Puedes agregar aquí opciones para personalizar el aspecto de la gráfica
    }
  });
</script>

@endsection