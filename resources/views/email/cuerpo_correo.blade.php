<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; padding: 20px;">

    <h2 style="color: #198754;">¡Gracias por tu compra, {{ $user->nombre_apellido }}!</h2>
    <p>Tu pedido fue procesado correctamente el <strong>{{ $fecha }}</strong>.</p>
    <p>Adjunto a este correo encontrás tu comprobante en PDF con el detalle completo.</p>

    <p style="font-size: 18px;">Total abonado: <strong>${{ number_format($total, 2) }}</strong></p>

    <hr>
    <p style="color: #888; font-size: 12px;">Evolvex — Suplementos y accesorios deportivos</p>

</body>
</html>