<!DOCTYPE html>
<html>
<head>
    <title>Relatório Geral</title>
</head>
<body>
    <h1>Relatório Geral</h1>
    <p>Período: {{ $startDate }} a {{ $endDate }}</p>

    <table border="1">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $movimento)
                <tr>
                    <td>{{ $movimento->descricao }}</td>
                    <td>{{ $movimento->valor }}</td>
                    <td>{{ $movimento->data }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>