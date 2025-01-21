<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soy un maestro</title>
</head>
<body>
    <header>
        Header
    </header>
    <!--Serveix per no haber de repetir codi a cada vista,
         el codi de aqui s'aplicara a les vistes que desitjem-->
    @yield('contect')
    <section>
        @yield('moreContect')
    </section>
</body>
</html>