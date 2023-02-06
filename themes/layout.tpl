<!DOCTYPE html>
<html lang="vi">

<head>
    <title>example</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Language" content="vi" />
    {% include 'partials/styles.php' %}
</head>

<body>
    {% block body %}{% endblock %}
    {% include 'partials/script.php' %}
</body>

</html>