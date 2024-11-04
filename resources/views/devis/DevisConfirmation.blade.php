@php use Illuminate\Support\Carbon; @endphp
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

            padding: 10px;
            display: flex;
            flex-direction: column;

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

        .info {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .info-item-list {
            display: flex;
            margin-right: 3rem;
            justify-content: flex-end;

        }

        .info-item-list-left {
            display: flex;
            justify-content: flex-start;

        }

        .info-item {
            padding-bottom: 0; /* Remove padding */
            margin-bottom: 0; /* Remove margin */
        }

        .logo {
            text-align: left;
            padding-right: 20px;
            padding-bottom: 20px;
        }

        .info-table {
            width: auto; /* Table width adapts to content */
            border-collapse: collapse;
            table-layout: auto; /* Allows column widths to adjust based on content */
            max-width: 30%;
            border: none;
            margin-left: 3rem;
        }

        .info-table td {
            padding: 2px 5px; /* Minimal padding for compact layout */
            vertical-align: top;
            border: none;
            white-space: nowrap;

        }
    </style>
</head>
<body>
<div class="header">
    <div class="logo">
        <img
            src='https://backline.onebigcartel.com/storage/LogoOneBigCartel.jpg'
            height="87"
            width="auto" alt=""/>
    </div>
    <div class="info">
        <div class="info-item-list-left">
            <table class="info-table">
                <tr>
                    <td><strong>Date:</strong></td>
                    <td>{{ Carbon::today()->toDateString() }}</td>
                </tr>
                <tr>
                    <td><strong>Société:</strong></td>
                    <td><p>{{ $company->name }}</p></td>
                </tr>
                <tr>
                    <td><strong>Adresse:</strong></td>
                    <td>{{ $company->adresse }} {{$company->town}}</td>
                </tr>
                <tr>
                    <td><strong>Tel:</strong></td>
                    <td>{{ $company->phone }}</td>
                </tr>
                <tr>
                    <td><strong>Tel:</strong></td>
                    <td>{{ $company->phone }}</td>
                </tr>
                <tr>
                    <td><strong>@:</strong></td>
                    <td>{{ $company->mail }}</td>
                </tr>
                <tr>
                    <td><strong>Siret:</strong></td>
                    <td>{{ $company->siret}}</td>
                </tr>
            </table>
        </div>
        <div class="info-item-list">
            <table class="info-table">
                <tr>
                    <td><p><strong>Société:</strong></p></td>
                    <td><p>{{ $client->$company }}</p></td>
                </tr>
                <tr>
                    <td><p><strong>Client:</strong></p></td>
                    <td><p>{{ $client->firstname }} {{ $client->lastname }}</p></td>
                </tr>
                <tr>
                    <td><p><strong>Email:</strong></p></td>
                    <td>
                        <p>{{ $client->mail }}</p></td>
                </tr>
                <tr>
                    <td><p><strong>Téléphone:</strong></p></td>
                    <td><p> {{ $client->phone }}</p></td>
                </tr>
                <tr>
                    <td><p><strong>Adresse:</strong></p></td>
                    <td><p> {{ $client->address }}</p></td>
                </tr>
            </table>
        </div>
    </div>
    {{--    <p>{{ $company->name }} - {{ $company->email }}</p>--}}
    <p>{{ $company->address }}</p>
</div>

<div class="content">


    <h2>Détails du devis</h2>
    <table>
        <thead class="thead-dark">
        <tr class="accent-green-200">
            <th>Description</th>
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
                <td>{{ number_format($material->price, 2, ',', ' ') }} €</td>
                <td>{{ number_format($material->price * $material->quantity, 2, ',', ' ') }} €</td>
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
        {{--        <p><strong>Lieu:</strong> {{ $location->address }}</p>--}}
        {{--        <p><strong>Date:</strong> {{ $location->from}} - {{$location->to}}</p>--}}
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
