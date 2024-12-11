<!DOCTYPE html>
<html>
<head>
    <title>Relatório DRE</title>
</head>
<body>
    <h1>Relatório DRE</h1>
    <p>Período: {{ $startDate }} a {{ $endDate }}</p>

    <table border="1">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Total</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $tipo => $info)
                <tr>
                    <td>{{ $tipo }}</td>
                    <td>{{ $info['total'] }}</td>
                    <td>{{ $info['quantidade'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>