@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Мои работы</div>
                    {{ session('addWorkResult') }}
                    <div class="panel-body">
                        <? if (empty($works)) { ?>
                        <p>У вас пока нет работ</p>
                        <? } else { ?>
                        <? foreach ($works as $work) { ?>
                        <p><a href="/cabinet/work/<?= $work['workId'] ?>"><?= $work['workName'] ?></a></p>
                        <? } ?>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
