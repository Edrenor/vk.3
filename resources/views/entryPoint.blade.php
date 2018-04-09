<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <head>
        <title></title>
    </head>
    <body>

        <div class="container">





            <!-- Content here -->
            @foreach($array as $row)
                <div class="form-group">

                <div class="card text-center">
                    <div class="card-header">
                        Featured
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text" style="text-align: left">
                            <span>{{$row['text']}}</span>
                        </p>
                        @if (array_key_exists("attachments", $row))
                            <div class="row">
                                @foreach($row['attachments'] as $attachment)
                                    <div class="col-4">
                                        @if ($attachment['type'] == "photo")
                                            <img src="{{$attachment['url']}}" style="max-width: 100%;">
                                        @elseif ($attachment['type'] == "doc")
                                            <img src="{{$attachment['url']}}" style="max-width: 100%;">
                                        @elseif ($attachment['type'] == "video")
                                            <iframe width='480' height='360' src='{{$attachment['url']}}' frameborder='0' allowfullscreen></iframe>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <a href='{{ route('postSave', ['id' => $row['id']]) }}' class="btn btn-primary" target='_blank'>
                            Пиздануть
                        </a>
                    </div>
                    <div class="card-footer text-muted">
                        {{$row['date']}}
                    </div>
                </div>
                </div>
            @endforeach
        </div>

    <!--/save.php?id=" . $post_id["0"]["id"] . "
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="..." alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a>
    </div>

    -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    </body>
</html>