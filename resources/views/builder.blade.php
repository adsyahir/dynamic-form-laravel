<html>

<head>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdn.form.io/formiojs/formio.full.min.css'>
    <script src='https://cdn.form.io/formiojs/formio.full.min.js'></script>
</head>

<body class="pl-64 d-flex align-items-start ">
  
    <div class="container mx-auto rounded-lg shadow-lg bg-white p-4 mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Form Builder Demo</h1>
            </div>

            <div class="col-md-6 text-right">
                <!-- This form holds the JSON form definition. -->
                <form method="post" action="{{ route('form-builder.store') }}">
                    @csrf
                    <input type="hidden" name="definition" id="definition" value="">

                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-save" aria-hidden="true"></i>
                        Save Form
                    </button>
            </div>
        </div>
        <!-- Content here -->
        <div id="formio-builder"></div>
    </div>
    <script lang="text/javascript">
        window.onload = function() {
            new Formio.builder(
                document.getElementById('formio-builder'),
                @if (isset($definition))
                    {!! $definition !!}
                @else
                    {}
                @endif , {} // these are the opts you can customize
            ).then(function(builder) {
                // Exports the JSON representation of the dynamic form to that form we defined above
                document.getElementById('definition').value = JSON.stringify(builder.schema);

                builder.on('change', function(e) {
                    // On change, update the above form w/ the latest dynamic form JSON
                    document.getElementById('definition').value = JSON.stringify(builder.schema);
                })
            });;
        };
    </script>
</body>

</html>
