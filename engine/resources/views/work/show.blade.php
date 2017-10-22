@extends('layouts.app')

@section('content')
    <section class="work">
        <div class="container">
            <div class="work__header flex">
                <h2 class="work__title"><?= $work['workName'] ?></h2>
                <a href="#" class="work__author"><?= $work['author'] ?></a>
            </div>
            <div class="work__item">
                <div class="work__slider">
                    <ul class="bxslider">
                        <? if (empty($work['images'])) { ?>
                        <p>У этой работы нет изображений</p>
                        <? } else { ?>
                        <? foreach ($work['images'] as $image) { ?>
                        <pre>
                            <? if ($image['isDefault']) { ?>
                            <p>это изображение по умолчению</p>
                            <? } ?>
                            <li><img src="<?= $image['link']?>" alt="" class="work__pic"></li>
                        </pre>
                        <? } ?>
                        <? } ?>
                    </ul>
                </div>
                <div class="work__desc">
                    <p>
                        <?= $work['description'] ?>
                    </p>
                </div>
            </div>
            <div class="work__toolbar">
                <div class="work__counts">
                    <div class="work__likes">
                        <a href="#"></a>
                        <span><?= $work['likes'] ?></span>
                    </div>
                    <div class="work__commentsNum">
                        <a href="#"></a>
                        <span>15</span>
                    </div>
                </div>
                <div class="work__circles">
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/1.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/2.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/3.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/4.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/6.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/7.png" alt="">
                    </div>
                    <div class="work__circle">
                        <span>Бумага</span>
                        <img src="images/icons/4.png" alt="">
                    </div>
                </div>

                <button class="work__buyBtn button">Заказать</button>
            </div>
            <div class="work__meta">
                <span>мета теги:</span>

                <a href="#">светильник,</a>
                <a href="#">статуэтка,</a>
                <a href="#">настенное,</a>
                <a href="#">небольшое,</a>
                <a href="#">животные,</a>
                <a href="#">металл,</a>
                <a href="#">интерьер,</a>
                <a href="#">мужское,</a>
                <a href="#">детям,</a>
                <a href="#">220v,</a>
                <a href="#">светодиод,</a>
                <a href="#">дрель клепки,</a>
                <a href="#">паяльник,</a>
                <a href="#">винтики-и-болтики,</a>
                <a href="#">немного-фантазии</a>
            </div>
        </div>
    </section>
@endsection
