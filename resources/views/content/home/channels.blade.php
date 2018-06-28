<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Каналы в telegram</h4>
                <div class="btn-group pull-right">
                    <a href="/channel/" class="btn btn-success btn-sm">## Добавить</a>
                </div>
            </div>
            <div class="panel-body">
                @if (count($channelsTg))
                    <div class="table-responsive">

                        <table class="table table-hover table-condensed table-striped">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Наименование</th>
                                <th>Источники</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($channelsTg as $channelTg)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$channelTg->name}}</td>
                                    <td>
                                        @foreach($sourcesForChannels as $key=>$sourcesForChannel)
                                            @if($key == $channelTg->name)
                                                @foreach($sourcesForChannel as $source)
                                                    {{$source}}
                                                    <br/>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="text-align: right">
                                        <a href="{{route('channel', ['id' => $channelTg->id])}}"
                                           class="btn btn-success btn-sm">Статистика
                                        </a>
                                        <br/>
                                        <a href="{{route('channel', ['id' => $channelTg->id])}}"
                                           class="btn btn-warning btn-sm" style="margin-top: 5px">Настройки канала</a>
                                        <br/>
                                        <a href="{{route('channel', ['id' => $channelTg->id])}}"
                                           class="btn btn-danger btn-sm" style="margin-top: 5px">Удалить канал</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    Вы еще не добавили ни одного канала
                @endif
            </div>
        </div>
    </div>
</div>

