<html>

<head>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdn.form.io/formiojs/formio.full.min.css'>
    <script src='https://cdn.form.io/formiojs/formio.full.min.js'></script>
</head>

<body> 
    
    <div class="container mx-auto 	rounded-lg shadow-lg bg-white p-4 mt-5">

        <div class="row">
            <div class="col-6">
                <h5 class="fs-1">Form Builder Demo</h5>
            </div>

            <div class="col-md-6 text-right">
                <!-- This form holds the values the user has entered, as a JSON document. -->
                <form method="post" action="{{ route('form.store') }}" id="submissionForm">
                    @csrf

                    <!-- State can be used to capture a Submit vs. Save Draft button -->
                    <input type="hidden" name="state">

                    <!-- The JSON with all the values -->
                    <input type="hidden" name="submissionValues" id="submissionValues" value="">
            </div>
        </div>

        <!-- Any server-side errors will be shown here. This is a fallback for when the client-side validations miss something. -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <p style="font-size: 16pt"><strong>Oops</strong>, there was an issue with that.</p>
                <ul class="ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- This becomes the builder. -->
        <div id="formio-form"></div>
    </div>
    <script lang="text/javascript">
        window.onload = function() {
            Formio.createForm(document.getElementById('formio-form'), {!! $definition !!}).then(function(form) {
                form.submission = {
                    data: {!! $data !!},
                };

                form.on('submit', function(submission) {
                    var submitForm = document.getElementById('submissionForm');
                    submitForm.querySelector('input[name=state]').value = submission.state;
                    submitForm.querySelector('input[name=submissionValues]').value = JSON.stringify(
                        submission.data);

                    submitForm.submit();
                });
            });
        };
    </script>
</body>

</html>
