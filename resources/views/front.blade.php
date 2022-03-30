<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Front</title>
    {{-- Colleghiamo il foglio di stile che abbiamo generato nel public--}}
    <link rel="stylesheet" href="{{asset("css/front.css")}}">
</head>
<body>
    {{-- Come su Vue, aggiungiamo il div con id app per richiamare il componente di radice --}}
    <div id="app">

    </div>
    {{-- Colleghiamo lo script che abbiamo generato nel public--}}
    <script src="{{asset("js/front.js")}}"></script>
</body>
</html>