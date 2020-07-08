<!doctype html>
<html lang="fr">

<head>
    <title>Docker</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
</head>

<body>
<h1 class="text-center">Docker Containers</h1>
<div class="container">

    <div class="row">
        @foreach ($containers as $c)
            <div class="col-md-4 mb-2">
                <div class="card shadow shadow-lg">
                    <div class="card-body">
                        <span class="badge badge-primary mb-4">{{ $c['Image'] }}</span>
                        @foreach ($c['Names'] as $name)
                        <form method="POST" action="{{url("/renameContainer/{$c['Id']}")}}">
                            <input type="text" name="name" class="text-center form-control" value="{{ substr($name,1) }}"/>
                        </form>
                        @endforeach
                        <small style="font-style: italic">{{$c['Id']}}</small>
                        <p>{{ $c['Command'] }}</p>
                        <p>{{ $c['Status'] }}</p>
                        <a href="{{url("/container/{$c['Id']}")}}" class="btn btn-success btn-rounded">See more</a>
                        <a class="btn btn-danger btn-rounded" onclick="return confirm('Are you sure?')" href="{{url("/stopContainer/{$c['Id']}")}}">Stop Container</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>

</html>
