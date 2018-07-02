<?php /**
 * Created by PhpStorm.
 * User: алексей
 * Date: 01.07.2018
 * Time: 20:21
 */ ?>
<div class="modal" id="settings_source_1">
    <div class="modal-dialog" style="    width: 795px;max-width: 795px;">
        <div class="modal-content">
            <! --Modal Header-->
            <div class="modal-header">
                <h4 class="modal-title"> Настройки канала {{$source}}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container-fluid">

                    <form action="#добавить_роут_вида-route('update_source', ['id' => $source->id])" method="post">
                        <div class="panel-body">
                            {{csrf_field()}}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link disabled">Тип доступа</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                       aria-controls="home" aria-selected="true">Открытый</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                       aria-controls="profile" aria-selected="false">Токен группы</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                       aria-controls="contact" aria-selected="false">Токен приложения</a>
                                </li>
                            </ul>
                            <div class="tab-content clearfix" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="name" class=" col-form-label">Ссылка на группу вк</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   value="$source->name">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="link" class="col-form-label">Ссылка на канал( необязательно
                                                                                     )</label>
                                            <input type="text" class="form-control" name="link" id="link"
                                                   value="$source->link">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="token" class="col-form-label">Токен бота телеграмм</label>
                                            <input type="text" class="form-control" name="token" id="token"
                                                   value="$source->token">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                Недоступно
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                Недоступно
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Сохранить</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
