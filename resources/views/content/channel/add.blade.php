@extends('layouts.app_bs4')

@section('content')
    <div class="container">
        <br/>
        <div class="card">
            <div class="card-header text-center">
                <h4>Добавление telegram канала</h4>
            </div>
            <div class="card-body">
                <!--Форма с информацией о телеграм боте-->
                <form action="{{ route('update_channel', ['id' => $channel->id]) }}" method="post">
                    <div class="panel-body">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="name" class=" col-form-label">Наименование</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{{$channel->name}}">
                            </div>
                            <!--Поле с наименованием канала-->
                            <div class="form-group col-sm-6">
                                <label for="link" class="col-form-label">Ссылка на канал( необязательно )</label>
                                <input type="text" class="form-control" name="link" id="link"
                                       value="{{$channel->link}}">
                            </div>
                            <!--Поле ссылки на канал-->
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="token" class="col-form-label">Токен бота телеграмм</label>
                                <input type="text" class="form-control" name="token" id="token"
                                       value="{{$channel->token}}">
                            </div>
                        </div>
                        <!--Поле с токеном телеграм бота-->
                        <div class="col-md-12" style="margin-top: 10px">
                            <button class="btn btn-success">Сохранить</button>
                        </div>
                        <!--Кнопка "Ссхранить"-->
                    </div>
                </form>
            </div>
        </div>
        <!--блок каналоа-->
        <br/>
        @if($channel->id)
            <div class="card ">
                <div class="card-header text-center">
                    <h4>Источники для канала</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">

                        <form action="{{ route('update_source', ['channel_id' => $channel->id]) }}"
                              method="post">
                            {{ csrf_field() }}
                            <div class="panel-body">
                                <!-- TODO:саня -->
                                <!--
                                 короче, тут по нажатию кнопки добавить должна открываться модалка,
                                 и в нее прикрутить аякс, обратить внимание,
                                 что id модалок не должны повторяться,
                                 а после отправки эту модалку надо очищать
                                -->
                                <label for="name">Добавить источник </label>
                                <input type="text" class="form-control" name="link" id="add_link_group">
                                <input type="text" class="form-control" name="owner" id="add_link_group">
                                <input type="text" class="form-control" name="name" id="add_link_group">

                                <div class="col-md-12" style="margin-top: 10px">
                                    <button class="btn btn-success">Добавить источник</button>
                                </div>
                                <!--кнопка добавления источников-->
                            </div>
                            <!--Блок добавления источника-->
                        </form>
                    </div>
                    @if(!$sourceForChannel)
                        Источников пока нет, вы можете их добавить.<br>
                    @else
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-condensed table-striped table-sm ">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>№</th>
                                            <th>Название</th>
                                            <th>Опции</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sourceForChannel as $key=>$sourceForChannel1)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$sourceForChannel1->name}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                            data-toggle="modal" data-target="#settings_source_1">
                                                        Настроить
                                                    </button>
                                                    {{--@include('content.source.modal_add')--}}
                                                </td>
                                                <td>
                                                    <form method="post"
                                                          action="{{ route('delete_source', ['source' => $sourceForChannel1->id,'channel_id' => $channel->id] ) }}">
                                                        {{csrf_field()}}
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <input class="btn btn-danger" type="submit"
                                                               value="Удалить"/>

                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div><!--блок источников-->
        @endif
    </div>

@endsection


