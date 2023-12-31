<head>
    @php
        $route = \Illuminate\Support\Facades\Route::currentRouteName();
        switch ($route) {
            case 'dashboard':
                $title = 'Dashboard';
                break;
            case 'profile.edit':
            case 'profile.update':
            case 'profile.destroy':
                $title = 'Profile';
                break;
            case 'products.index':
            case 'products.product':
                $title = 'Products';
                break;
            case 'cart.index':
            case 'cart.data':
                $title = 'Cart';
                break;
            case 'checkout.index':
                $title = 'Checkout';
                break;
            case 'products.edit':
            case 'products.update':
            case 'products.destroy':
                $title = 'Manage Products';
                break;
            default:
                $title = 'Spare Realm™️';
        }
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slick-theme.css') }}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}"/>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
