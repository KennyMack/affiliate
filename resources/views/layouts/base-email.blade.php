<style type="text/css">
    body {
        padding: 0;
        margin: 0;
        max-width: 800px;
        font-family: Arial;
    }
    * {

        box-sizing: border-box;
    }

    .wrap-content {
        box-sizing: border-box;
    }

    .header {
        padding: 20px;
        box-sizing: border-box;
        background-color: #858585;
        color: #D2D2D2;
    }
    .header .logo {
        float: left;
    }
    .logo img {
        width: 120px;
        height: 80px;
    }

    .header .title {
        text-align: center;
        font-size: .8rem;
    }

    .body {
        padding: 20px;
        font-weight: bold;
        float: left;
        display: block;
        width: 100%;
        color: #858585;
        background-color: #D2D2D2;
        font-size: 1.2rem;
        line-height: 1.8rem;
    }

    .footer {
        background-color: #858585;
        color: #D2D2D2;
        display: block;
    }
    .footer p {
        display: block;
        text-align: center;
        line-height: 60px;

    }

</style>

<div class="wrap-content">
    <div class="header">
        <div class="logo">
        @if ($type == 'CONVIDA')
            <img src="{{ asset('/assets/img/logo.png') }}" alt="logotipo da empresa">
        @else
            <img src="{{ asset('/assets/img/logo_vantagens.png') }}" alt="logotipo da empresa">
        @endif
        </div>
        <div class="title">
            @if (isset($title))
                <h1>{{ $title }}</h1>
            @endif
        </div>

    </div>
    <div class="body">

        @yield('content')
    </div>
    <div class="footer">
        <p>{{ date("Y")  }} {{ $type }}.</p>
    </div>
</div>

