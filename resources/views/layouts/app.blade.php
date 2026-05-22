<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-color:bisque;
        }

        nav ul li{
            display: inline;
            background-color: white;
            border: 1pt solid;
            color: darkslategrey;
            margin: 30pt;
            padding:10pt;
        }

        table, th, td{
            border-collapse: collapse;
            border: 1pt solid;
        }

        .comment{
            background-color: antiquewhite;
            border: 1pt solid;
            margin: 10pt 10pt 10pt 30pt;
            padding: 10pt;
            font-family: sans-serif;
        }

        .comment h3{
            color: darkslategrey;
        }

        .advertisement{
            background-color: white;
            border: 1pt solid;
            margin: 10pt;
            padding: 10pt;
            font-family: sans-serif;
        }

        .formitem{
            background-color: white;
            border: 1pt solid;
            margin: 10pt;
            padding: 10pt;
            font-family: sans-serif;
        }

        .themelabel{
            background-color: navy;
            color: white;
            border: 1pt solid bisque;
        }
    </style>


    <title>App Name - @yield('title')</title>
</head>
<body>
    @include('partials.nav')
    @yield('content')
</body>
</html>