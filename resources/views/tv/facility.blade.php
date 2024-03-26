<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<header style="width:200px;">
<div >

@foreach($facilities as $facility)
<nav class="navbar bg-body-tertiary ">
  <div class="container-fluid">
    <a class="navbar-brand text-green" href="{{$Gid}}/show/{{$Fid = $facility->id}}"> {{ $facility->facility_name_jp }}</a>
  </div>
</nav>
@endforeach
</div>
</header>
<main style="padding-left:250px;">
<img src="{{ asset($img) }}" class="img-fluid" alt="...">
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>