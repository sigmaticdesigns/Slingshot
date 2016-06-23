
<div class="main-footer__wrapper">
    <div class="rights">
        <div class="rights__logo"><a href="/">slingshot</a></div>
        <div class="rights__cont">© 2016  All Rights Reserved</div>
    </div>
    <div class="main-footer__middle-wrapper">
        <div class="footer-social">
            <div class="footer-social__title">Follow us</div>
            <div class="footer-social__wrap">
                <a href="{!! option('facebook.link') !!}" class="footer-social__btn footer-social__btn--fb">Facebook</a>
                <a href="{!! option('twitter.link') !!}" class="footer-social__btn footer-social__btn--tw">Twitter</a>
                <a href="{!! option('google.link') !!}" class="footer-social__btn footer-social__btn--google">Google plus</a>
                <a href="{!! option('instargam.link') !!}" class="footer-social__btn footer-social__btn--insta">Instargam</a>
                <a href="{!! option('linkedin.link') !!}" class="footer-social__btn footer-social__btn--in">Linkedin</a>
            </div>
        </div>
        <div class="footer-payment">
            <div class="footer-payment__title">We accept</div>
            <div class="footer-payment__wrap">
                <div class="footer-payment__item footer-payment__item--paypal">PayPal</div>
                <div class="footer-payment__item footer-payment__item--master">MasterCard</div>
            </div>
        </div>
    </div>
    <div class="footer-menu">
        <div class="footer-menu__about">
            <div class="footer-menu__title">About us</div>
            <ul class="footer-menu__list">
                @foreach(\App\Page::menu(1) as $page)
                    <a href="{{ url($page->slug) }}">{!! $page->title !!}</a><br>
                    <li class="footer-menu__item">
                        <a href="{{ url($page->slug) }}">{!! $page->title !!}</a>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="footer-menu__help">
            <div class="footer-menu__title">Help</div>
            <ul class="footer-menu__list">
                @foreach(\App\Page::menu(2) as $page)
                    <a href="{{ url($page->slug) }}">{!! $page->title !!}</a><br>
                    <li class="footer-menu__item">
                        <a href="{{ url($page->slug) }}">{!! $page->title !!}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>