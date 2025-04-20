<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css')}}" />
    @vite(['resources/js/app.js','resources/css/app.css'])
    
    @inertiaHead
  </head>
  <body class="body-bg min-h-screen  pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
    @inertia
  </body>
</html>