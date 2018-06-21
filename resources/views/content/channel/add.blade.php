@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Добавление telegram канала</h2>

            <div class="panel panel-default">
                <form action="{{ route('update_channel', ['id' => $channel->id]) }}" method="post">
                    <div class="panel-body">
                        {{csrf_field()}}
                        <div class="col-md-12">
                            <label for="name">Наименование</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$channel->name}}">
                        </div>
                        <div class="col-md-12">
                            <label for="name">Токен бота телеграмм</label>
                            <input type="text" class="form-control" name="token" id="token" value="{{$channel->token}}">
                        </div>
                        <div class="col-md-12">
                            <label for="name">Ссылка на канал( необязательно ) </label>
                            <input type="text" class="form-control" name="link" id="link" value="{{$channel->link}}">
                        </div>
                        {{--<div class="col-md-12">--}}
                        {{--<label for="name">Тип доступа</label>--}}
                        {{--<br/>--}}
                        {{--<input type="radio" name="type" value="open">Открытый--}}
                        {{--<input type="radio" name="type" value="group_token">Токен группы--}}
                        {{--<input type="radio" name="type" value="app_token">Токен приложения--}}
                        {{--</div>--}}
                        <div class="col-md-12" style="margin-top: 10px">
                            <button class="btn btn-success">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


