@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><?= $work['workName'] ?></div>
                    <div class="panel-body">
                        <p>Описание <?= $work['description'] ?></p>
                        <p>Лайков <?= $work['likes'] ?></p>
                        <? if (empty($work['images'])) { ?>
                        <p>У этой работы нет изображений</p>
                        <? } else { ?>
                        <? foreach ($work['images'] as $image) { ?>
                            <pre>
                            <? if ($image['isDefault']) { ?>
                                <p>это изображение по умолчению</p>
                            <? } ?>
                                <img src="<?= $image['link']?>" alt=""/>
                            </pre>
                        <? } ?>
                        <? } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
