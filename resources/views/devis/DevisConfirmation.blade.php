<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
        }

        .header, .footer {
            text-align: center;
            padding: 10px;
            background-color: #f8f8f8;
            border-bottom: 1px solid #ddd;
        }

        .content {
            margin: 20px;
        }

        .company-info, .client-info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }

        .total-row td {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Devis de Confirmation</h1>
    <p>{{ $company->name }} - {{ $company->email }}</p>
    <p>{{ $company->address }}</p>
</div>

<div class="content">
    <div class="company-info">
        <h2>Informations de l'entreprise</h2>
        <p><strong>Entreprise:</strong> {{ $company->name }}</p>
        <p><strong>Email:</strong> {{ $company->mail }}</p>
        <p><strong>Adresse:</strong> {{ $company->address }} {{$company->town}} {{$company->country}}</p>
    </div>

    <div class="client-info">
        <h2>Informations du client</h2>
        <p><strong>Société:</strong> {{ $client->$company }}</p>
        <p><strong>Client:</strong> {{ $client->firstname }} {{ $client->lastname }}</p>
        <p><strong>Email:</strong> {{ $client->mail }}</p>
        <p><strong>Téléphone:</strong> {{ $client->phone }}</p>
        <p><strong>Adresse:</strong> {{ $client->address }}</p>
    </div>

    <h2>Détails du devis</h2>
    <table>
        <thead>
        <tr>
            <th>Description</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($materials[0] as $material)

            <tr>
                <td>{{ $material->brand }} <strong>{{ $material->model }}</strong></td>
                <!-- Now, each $material is a single item from the collection -->
                <td>1</td>
                <td>{{$material->price}}</td>
                {{--                <td>{{ number_format($material->price, 2, ',', ' ') }} €</td>--}}
                {{--                <td>{{ number_format($material->price * $material->quantity, 2, ',', ' ') }} €</td>--}}
            </tr>
        @endforeach
        @foreach($devis->prestations as  $prestation)
            <tr>
                <td><strong>{{ $prestation->name }}  </strong> {{ $prestation->description }}</td>
                <!-- Now, each $material is a single item from the collection -->
                <td>1</td>
                <td>{{$prestation->price}}</td>
            </tr>
        @endforeach
        <tr class="total-row">
            <td colspan="3" class="total">Total</td>
            <td>{{$devis->getAmountAttribute()}} €</td>
        </tr>
        @if($devis->hasReduction())
            <tr class="total-row">
                <td colspan="3" class="total">Total après Réduction</td>
                <td>{{$devis->getFinalAmountAttribute()}} €</td>
            </tr>
        @endif>
        </tbody>
    </table>

    <div class="location-info">
        <h2>Informations sur la location</h2>
        <p><strong>Lieu:</strong> {{ $location->address }}</p>
        <p><strong>Date:</strong> {{ $location->from}} - {{$location->to}}</p>
    </div>
</div>

@if($url && $token)
    <div class="footer">
        <p>Merci pour votre confiance. Si vous avez des questions, veuillez contacter {{ $user->email }}.</p>
        <a href="{{$url.'/'.$token}}">Veuillez nous confirmer votre accteptation ici</a>
        @endif
    </div>
</body>
</html>
