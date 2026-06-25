<!DOCTYPE html>
<html lang="es">

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
                <th class="text-center" style="width: 10%;">Cant.</th>
                <th class="text-end" style="width: 20%;">Precio</th>
                <th class="text-end" style="width: 20%;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->producto ? $item->producto->nombre : 'Producto no disponible' }}</td>
                    <td class="text-center">{{ $item->cantidad }}</td>
                    <td class="text-end">${{ number_format($item->precio_unitario, 2, ',', '.') }}</td>
                    <td class="text-end">${{ number_format($item->subtotal, 2, ',', '.') }}</td>
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