<!--mensages de error-->
@if(isset($errors) && count($errors) > 0)
        @foreach($errors->all() as $error)
            <script>
                swal({
                  title: "¡Upps... Hubo un problema!",
                  text: '{{ $error }}',
                  icon: 'error',
                });
            </script>
        @endforeach
@endif
<!--mensage de exito-->
@if(Session::get('success', false))
    <?php $data = Session::get('success');?>
    @if(is_array($data))
        @foreach($data as $menssage)
            <script>
                swal({
                  title: "¡Proceso realizado!",
                  text: '{{ $message }}',
                  icon: 'success',
                });
            </script>
        @endforeach
        @else 
            <script>
                swal({
                  title: "¡Proceso realizado!",
                  text: '{{ $data }}',
                  icon: 'success',
                });
            </script>
        @endif
@endif


