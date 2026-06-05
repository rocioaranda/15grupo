<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Compra</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #28a745; padding-bottom: 10px; }
        .total { font-size: 1.5rem; color: #28a745; text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2 f2 f2; }
    </style>
</head>
<body>
    <div class="header">
        <h1>EVOLVEX SUPLEMENTOS</h1>
        <p>Gracias por tu compra, {{ $user->nombre_apellido }}</p>
    </div>
    <p>Fecha: {{ $fecha }}</p>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Precio Unit.</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->producto->nombre }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>${{ number_format($item->precio_unitario, 2) }}</td>
                <td>${{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p class="total">Total Pagado: ${{ number_format($total, 2) }}</p>
</body>
</html>