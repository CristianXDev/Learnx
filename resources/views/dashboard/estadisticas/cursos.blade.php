@extends('sources-dashboard')

@section('title')

<title>LearnX | Estadisticas Cursos</title>

@endsection

@section('content')

<div class="col-md-4 mb-5">
  <div class="card">
    <div class="card-body text-center">
      <h4>Cursos por tipo<h4>

        @if($cursos_premium->count() != 0 || $cursos_gratis->count() != 0)
        <div>
          <canvas id="chart1"></canvas>
        </div>

        @else

        <h5 class="text-muted">No hay cursos registrados</h5>

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
    labels: ['Cursos gratis', 'Cursos premium',],
    datasets: [{
    label: 'Cursos',
    data: [{{ $cursos_gratis->count() }}, {{ $cursos_premium->count() }}],
    backgroundColor: [
    'rgba(51, 102, 255, 0.6)', // Azul brillante
    'rgba(204, 51, 153, 0.6)' // Rosado oscuro
    ],
    borderColor: [
    'rgba(51, 102, 255, 1)', // Azul brillante
    'rgba(204, 51, 153, 1)' // Rosado oscuro
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