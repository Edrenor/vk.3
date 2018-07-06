<?php /**
 * Created by PhpStorm.
 * User: алексей
 * Date: 01.07.2018
 * Time: 20:21
 */ ?>
<div class="modal" id="settings_source_{{$sourceForChannel1->id}}">
    <div class="modal-dialog" style="    width: 795px;max-width: 795px;">
        <div class="modal-content">
            <! --Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"> Настройки канала {{$sourceForChannel1->name}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">

                    <form action="{{route('update_source', ['channel_id' => $channel->id,'id' => $sourceForChannel1->id])}}" method="post">
                        <div class="panel-body">
                            {{csrf_field()}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link disabled">Тип доступа</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="public-tab" data-toggle="tab" href="#public"
                                       role="tab"
                                       aria-controls="public" aria-selected="true">Открытый</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="callback-tab" data-toggle="tab" href="#callback" role="tab"
                                       aria-controls="callback" aria-selected="false">Callback</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="private-tab" data-toggle="tab" href="#private" role="tab"
                                       aria-controls="private" aria-selected="false">Токен приложения(для закрытых
                                                                                     групп)</a>
                                </li>
                            </ul>
                            <div class="tab-content " id="myTabContent">
                                <div class="tab-pane fade show active" id="public" role="tabpanel"
                                     aria-labelledby="public-tab">
                                    <div class="row">
                                        <div class="form-group col-sm-10">
                                            <label for="link_group" class=" col-form-label">Ссылка на группу
                                                                                            вк</label>
                                            <input type="text" class="form-control" name="link" id="link_group"
                                                   value="{{$sourceForChannel1->link}}">
                                        </div>
                                        <div class="form-group col-sm-2">
                                            {{--<label for="link_group" class=" col-form-label">(?)</label>--}}
                                            <button type="button" class="btn btn-success btn-sm" style="margin-top: 40px">check</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- TODO: саня -->
                                        <!-- короче их сделать readonly, и после нажатия кнопки check которая выше она ебашит аякс, который парсит страницу группы и заполняет вот эти поля, ок да?! -->
                                        <div class="form-group col-sm-6">
                                            <label for="name_group" class="col-form-label">Название группы</label>
                                            <input type="text" class="form-control"  name="name" id="name_group"
                                                   value="{{$sourceForChannel1->name}}">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="owner_group" class="col-form-label">Id Группы</label>
                                            <input type="text" class="form-control"  name="owner"
                                                   id="owner_group"
                                                   value="{{$sourceForChannel1->owner}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- TODO:саня -->
                                        <!-- типа настройки тут будут (короче тут чекбоксы надо заебашить, саня, ебись) -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="callback" role="tabpanel" aria-labelledby="callback-tab">
                                    Тип доступа "Callback" недоступен
                                </div>
                                <div class="tab-pane fade" id="private" role="tabpanel" aria-labelledby="private-tab">
                                    Тип доступа "Токен приложения(для закрытых групп)" недоступен
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success" >Сохранить(короче тут должен быть аякс, саня, ебись, мне лень)</button> <!-- TODO:саня -->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>

                    </form>
                </div>
            </div>
            <!-- Modal footer -->
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-success" data-dismiss="modal">Сохранить(короче тут должен быть аякс, саня, ебись, мне лень)</button> <!-- TODO:саня -->--}}
                {{--<button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
