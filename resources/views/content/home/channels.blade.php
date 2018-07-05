<div class="form-group row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header clearfix">
                <span class=" pull-xs-left">Каналы в telegram</span>
                <a href="/channel/"  class="btn btn-primary btn-sm float-right" >## Добавить</a>
            </div>
            <div class="card-body">
                @if (count($channelsTg))
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed table-striped">
                            <thead class="thead-light">
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
                                                    {{$source->name}}
                                                    <br/>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="text-align: right">
                                        <a href="{{route('channel_post', ['id' => $channelTg->id])}}"
                                           class="btn btn-success btn-sm">К постам
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
                    <span>Вы еще не добавили ни одного канала</span>
                @endif
            </div>
        </div>
    </div>
</div>

