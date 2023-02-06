<!-- <?php var_dump($data) ?> -->

{% block loop_items %}

<div class="product__item">
    <div class="product__item--img">
        <a href="article/{{data.slug}}">
            <img src={{ data.avatar_url|raw }} alt="avatar">
        </a>
    </div>
    <div class="product__item__decription">
        <h4 class="mb-3">
            <a href="article/{{data.slug}}">
                {{ data.title }}
            </a>
        </h4>
        <p class="mb-3 product__item__decription--detail">{{ data.intro }}</p>
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div class="d-inline-flex">
                <i class="lp-location me-2 d-flex align-items-center"></i>
                TP.Hồ Chí Minh
            </div>
            <div class="d-inline-flex">
                <i class="lp-time me-2 d-flex align-items-center"></i>
                3 ngày 2 đêm
            </div>
        </div>
        <div class="d-flex flex-wrap-reverse align-items-center product__item__decription--price gap-3">
            <div>7,790,000₫</div>
            <div class="d-flex align-items-center">7,290,000₫ <span>- 20%</span></div>
        </div>
        <div class="d-flex justify-content-around align-items-center gap-3 product__item__btn">
            <a href="cart.info" class="d-inline-flex justify-content-center align-items-center w-100">
                <i class="lp-cart me-2 d-flex align-items-center"></i>
                Mua ngay
            </a>
            <a href="tour.details" class="w-100 text-center">
                Xem chi tiết
            </a>
        </div>
    </div>
</div>
{% endblock %}