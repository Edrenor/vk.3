@extends('layouts.app_bs4')

@section('content')
    <!-- Content here -->
    <div class="container">
        <br>
        @foreach($array as $row)
            <div class="form-group">
                <div class="card text-center">
                    <div class="card-header">
                        <h5 class="card-title">Special title treatment</h5>
                    </div>
                    <div class="card-body">
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
                                            <iframe width='480' height='360' src='{{$attachment['url']}}'
                                                    frameborder='0'
                                                    allowfullscreen></iframe>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <a href='{{ route('postSave', ['id' => $row['id']]) }}' class="btn btn-primary" target='_blank'>
                            Выложить
                        </a>
                    </div>
                    <div class="card-footer text-muted">
                        {{$row['date']}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
