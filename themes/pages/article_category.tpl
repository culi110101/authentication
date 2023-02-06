{% extends 'layout.tpl' %}
{% block body %}
<div class="row">
    {% for data in items  %}
        <div class="col-12 col-md-6 col-lg-4 px-0 px-sm-3 py-3">
            {% include 'pages/article_item.tpl' %}
        </div>
    {% endfor %}
</div>
{% endblock %}