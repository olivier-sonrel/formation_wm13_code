<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        <h1>Pokemons</h1>
        <table>
            <tr>
                <th>N°</th>
                <th>Nom</th>
                <th>Type</th>
            </tr>
            {{dd($pokemons)}}
            @foreach ($pokemons as $pokemon )
                <tr>
                    <td>{{ $pokemon['numero'] }}</td>
                    <td>{{ $pokemon['name'] }}</td>
                    <td>{{ $pokemon['type'] }}</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
