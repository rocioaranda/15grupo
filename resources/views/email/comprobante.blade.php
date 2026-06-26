<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 14px; color: #333; }
        .header { border-bottom: 2px solid #28a745; padding-bottom: 10px; margin-bottom: 20px; }
        .title { font-size: 24px; font-weight: bold; color: #28a745; }
        .text-end { text-align: right; }
        .info-table { width: 100%; margin-bottom: 30px; }
        .info-td { vertical-align: top; width: 50%; }
        
        .items-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .items-table th { background-color: #f8f9fa; border-bottom: 2px solid #dee2e6; padding: 10px; text-align: left; }
        .items-table td { border-bottom: 1px solid #dee2e6; padding: 10px; }
        
        .total-row { font-weight: bold; font-size: 16px; background-color: #f8f9fa; }
        .total-price { color: #28a745; }
        
        .footer { margin-top: 50px; font-size: 12px; color: #6c757d; text-align: center; border-top: 1px solid #dee2e6; padding-top: 10px; }
    </style>
</head>
<body>

    <div class="header">
        <table style="width: 100%;">
            <tr>
                <td><span class="title">EVOLVEX</span></td>
                <td class="text-end" style="color: #6c757d; font-size: 14px;">COMPROBANTE DE COMPRA</td>
            </tr>
        </table>
    </div>

    <table class="info-table">
        <tr>
            <td class="info-td">
                <strong>Detalles del Cliente:</strong><br>
                Nombre: {{ $user->nombre_apellido ?? $user->name ?? 'Cliente Evolvex' }}<br>
                Email: {{ $user->email }}
            </td>
            <td class="info-td text-end">
                <strong>Detalles del Pedido:</strong><br>
                Fecha: {{ $fecha }}<br>
                Estado: Abonado
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>Producto</th>
                <th style="text-align: center; width: 10%;">Cant.</th>
                <th style="text-align: right; width: 20%;">Precio</th>
                <th style="text-align: right; width: 20%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->producto ? $item->producto->nombre : 'Producto no disponible' }}</td>
                    <td style="text-align: center;">{{ $item->cantidad }}</td>
                    <td style="text-align: right;">${{ number_format($item->precio_unitario, 2, ',', '.') }}</td>
                    <td style="text-align: right;">${{ number_format($item->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
            
            <tr class="total-row">
                <td colspan="3" class="text-end" style="color: #6c757d;">Total de la compra:</td>
                <td class="text-end total-price">${{ number_format($total, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Gracias por confiar en Evolvex Suplementos. Este documento sirve como comprobante oficial de tu transacción.
    </div>

</body>
</html>