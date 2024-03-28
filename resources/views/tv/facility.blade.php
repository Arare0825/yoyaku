<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<header style="height:50px; top:100px;">
headerlogo
</header>

<!-- <header style="width:200px;"> -->
<div style="float: left;">
@foreach($facilities as $facility)
<nav class="navbar" style="width:200px;">
  <div class="container-fluid">
    <!-- <a class="navbar-brand text-green" href="{{$Gid}}/show/{{$Fid = $facility->id}}"> {{ $facility->facility_name_jp }}</a> -->
    <form action="" method="get">
      @csrf
      <!-- <input type="hidden" name="number" value="{{ $facility->id }}"> -->
    <!-- <a class="navbar-brand text-green"> </a> -->
    <button type="submit" name="sec" value="{{ $facility->id }}" class="btn btn-primary btn-lg">{{ $facility->facility_name_jp }}</button>
    </form>
  </div>
</nav>
@endforeach
</div>
<!-- </header> -->

@foreach($facilities as $facility)
@if(isset($_GET['sec']) == null)
<!-- <img src="{{ asset($topImg) }}" class="img-fluid" alt="...">
 {{ $topFacility->facility_name_jp }} -->
 <div class="card " style="">
  <img src="{{ asset($topImg) }}" style="width:1700px; height:720px;" class="" alt="...">
  <div class="card-body" style="">
    <h5 class="card-title ">{{ $topFacility->facility_name_jp }}</h5>
    <p class="card-text">{{ $topFacility->facility_introduction }}</p>
    <a href="/tv/reservation/{{$topFacility->id}}" class="btn btn-primary">予約に進む</a>
  </div>
@break
@elseif($facility->id == $_GET['sec'])
<div class="card " style="">
  <img src="{{ asset('storage/facilityImages/' . $facility->facility_images) }}" style="width:1700px; height:720px;" class="" alt="...">
  <div class="card-body" style="">
    <h5 class="card-title ">{{ $facility->facility_name_jp }}</h5>
    <p class="card-text">{{ $facility->facility_introduction }}</p>
    <a href="/tv/reservation/{{$Fid = $facility->id}}" class="btn btn-primary">予約に進む</a>
  </div>

@endif
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>