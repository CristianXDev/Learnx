@extends('sources-dashboard')

@section('title')

<title>LearnX | Estadisticas Aulas</title>

@endsection

@section('content')

<div class="col-md-4 mb-5">
 <div class="card">
   <div class="card-body text-center">
    <h4>Aulas por tipo<h4>

      @if($classroom_privado->count() != 0 || $classroom_publico->count() != 0)

      <div class="d-flex justify-content-center flex-wrap">
        <div style="height:249px;">
          <canvas class="text-center" id="chart1"></canvas>
        </div>
      </div>

      @else
        <h5 class="text-muted">No hay aulas registradas</h5>
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
    labels: ['Aulas privadas', 'Aulas publicas'],
    datasets: [{
    label: 'Aulas',
    data: [{{ $classroom_privado->count() }}, {{ $classroom_publico->count() }}],
    backgroundColor: [
    'rgba(51, 102, 255, 0.6)', // Azul brillante
    'rgba(102, 51, 153, 0.6)', // Morado oscuro
    ],
    borderColor: [
    'rgba(51, 102, 255, 1)', // Azul brillante
    'rgba(102, 51, 153, 1)', // Morado oscuro
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