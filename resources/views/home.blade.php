<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('js/app.js')}}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
  <div id="appVue">
      <ul>
          <li v-for="i in 10" v-html="i">
          </li>
      </ul>
  </div>
  <script src="{{ asset('js/vue.js')}}"></script>
</body>
</html>