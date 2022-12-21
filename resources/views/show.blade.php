<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdn.form.io/formiojs/formio.full.min.css'>
    <script src='https://cdn.form.io/formiojs/formio.full.min.js'></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div id="formio-form"></div>
    <script lang="text/javascript">
        window.onload = function() {
            // The third param's readOnly flag turns off buttons & marks all fields as readonly.
            Formio.createForm(document.getElementById('formio-form'), {!! $definition !!}, {readOnly: true}).then(function (form) {
                form.submission = {
                    data: {!! $data !!},
            };
        });
    };
    </script>   
</body>
</html>