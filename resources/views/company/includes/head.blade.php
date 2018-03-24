<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Job Now | 
        @if(isset($title))
            {!! $title !!}
        @endif
    </title>

    <!-- Bootstrap Core CSS -->
    {{-- <link href="css/bootstrap.min.css" rel="stylesheet"> --}}
    {!! HTML::style('frontend/jobnow_backend/css/bootstrap.min.css') !!}
    {!! HTML::style('frontend/jobnow_backend/css/bootstrap-tagsinput.css') !!}
    {{-- <link rel="stylesheet" href="css/bootstrap-tagsinput.css"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    {{-- <link href="css/simple-sidebar.css" rel="stylesheet"> --}}
    {!! HTML::style('frontend/jobnow_backend/css/simple-sidebar.css') !!}
    {{-- <link rel="stylesheet" href="css/jobnow_t.css"> --}}
    {!! HTML::style('frontend/jobnow_backend/css/jobnow_t.css') !!}    
    {!! HTML::style('frontend/jobnow_backend/css/mystyle.css') !!}
    {!! HTML::style('frontend/jobnow_backend/css/dataTables.bootstrap.min.css') !!}
    
    
    @section('extra-style')
    @show
    <!-- jQuery -->
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->