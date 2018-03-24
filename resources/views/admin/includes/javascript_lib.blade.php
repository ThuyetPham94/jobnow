
    {!! HTML::script('./backend/plugins/jQuery/jQuery-2.1.4.min.js') !!}
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuZwCi-4pzqjrJ-ADryQ3QPAH0zPsbYz0&callback=initMap&libraries=places&sensor=false" async defer></script>
    <!-- Bootstrap 3.3.5 -->
    {!! HTML::script('./backend/bootstrap/js/bootstrap.min.js') !!}


    {!! HTML::script('./backend/plugins/slimScroll/jquery.slimscroll.min.js') !!}
    <!-- FastClick -->

    {!! HTML::script('./backend/dist/js/app.min.js') !!}

    {!! HTML::script('./backend/dist/js/demo.js') !!}
    {!! HTML::script('./backend/plugins/bootstrap-validations/dist/js/bootstrapValidator.js') !!}
    {!! HTML::script('jquery.validate.min.js') !!}
<!-- Thêm messages và confirm -->
@include('admin.includes.confirm')
@include('admin.includes.messages')

<!-- Thêm lib -->

@section('extra-lib')
@show