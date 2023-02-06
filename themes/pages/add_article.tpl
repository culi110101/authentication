{% extends 'layout.php' %}
{% block body %}
<div class="add_article container">
    <form action="add_article" method="POST" class="text-center" id="add_article">
        <div>
            <h1>Add Aticle</h1>
            <div class="mt-5">
                <h2>Title</h2>
                <input name="title"></input>
            </div>
            <div class="mt-5">
                <h2>Intro</h2>
                <input class="tiny" name="intro"></input>
            </div>
            <div class="mt-5">
                <h2>Content</h2>
                <textarea id="tinymce" name="content"></textarea>
            </div>
            <div class="mt-5">
                <h2>Img</h2>
                <input name="img"></input>
            </div>
        </div>
        <button type="submit" name="addArticle" class="updateinfor-btn"> Thêm bài viết </button>
    </form>
</div>
{% endblock %}