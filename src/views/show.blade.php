<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Docker information about container</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <a href="{{url('containers')}}" class="btn btn-block btn-success">Back to the list</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">{{substr($container['Name'],1)}}</h1>
            <h6 class="text-center font-italic">{{$container['State']['Status']}}
                since {{ (new Datetime(substr($container['State']['StartedAt'],0, 20)))->format('d/m/Y H:i:s') }}</h6>
        </div>
    </div>
    <div class="row mt-5">
        <table class="table table-dark">
            <tbody>
            <tr class="text-center">
                <td>Commande lancée</td>
                <td>{{implode(',',$container['Args'])}}</td>
            </tr>
            </tbody>
        </table>
        <hr>
        <h4>Volumes</h4>
        <table class="table table-dark mt-4">
            <thead>
            <tr>
                <th>Dossier distant</th>
                <th>Dossier local</th>
                <th>Droits d'écriture</th>
            </tr>
            </thead>
            <tbody>
            @foreach($container['HostConfig']['Binds'] as $volume)
                <tr>
                    <td>{{explode(':',$volume)[0]}}</td>
                    <td>{{explode(':',$volume)[1]}}</td>
                    <td>{{explode(':',$volume)[2] ?? ''}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
