@extends('layouts.app')

@section('main')
<div class="container py-5" style="max-width: 860px;">

    <h2 class="fw-bold text-success mb-4">
        <i class="bi bi-bag-check me-2"></i>Finalizar Compra
    </h2>

    {{-- Resumen del pedido --}}
    <div class="card bg-dark border-secondary mb-4">
        <div class="card-header text-success fw-bold border-secondary">
            <i class="bi bi-receipt me-2"></i>Resumen del pedido
        </div>
        <div class="card-body p-0">
            <table class="table table-dark table-hover mb-0 align-middle">
                <thead>
                    <tr class="text-success small text-uppercase border-secondary">
                        <th class="ps-3">Producto</th>
                        <th class="text-center">Cant.</th>
                        <th class="text-end pe-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr class="border-secondary">
                        <td class="ps-3 text-white">{{ $item->producto->nombre }}</td>
                        <td class="text-center text-white-50">{{ $item->cantidad }}</td>
                        <td class="text-end pe-3 text-white">${{ number_format($item->subtotal, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-secondary">
                    <tr>
                        <td colspan="2" class="text-end text-success fw-bold ps-3 border-0">Total:</td>
                        <td class="text-end pe-3 text-success fw-bold fs-5 border-0">
                            ${{ number_format($carrito->total, 2, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- FORMULARIO PRINCIPAL --}}
    <form action="{{ route('checkout.confirmar') }}" method="POST" id="form-checkout" novalidate>
        @csrf

        {{-- ── PASO 1: Datos del cliente ─────────────────────── --}}
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header text-success fw-bold border-secondary">
                <i class="bi bi-person me-2"></i>Datos del cliente
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-7">
                        <label class="form-label text-white">Nombre y Apellido <span class="text-danger">*</span></label>
                        <input type="text" name="checkout_nombre"
                               class="form-control bg-dark text-white border-secondary @error('checkout_nombre') is-invalid @enderror"
                               placeholder="Ej: Juan Pérez"
                               value="{{ old('checkout_nombre', $user->nombre_apellido) }}">
                        @error('checkout_nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-5">
                        <label class="form-label text-white">DNI <span class="text-danger">*</span></label>
                        <input type="text" name="checkout_dni" inputmode="numeric" maxlength="8"
                               class="form-control bg-dark text-white border-secondary @error('checkout_dni') is-invalid @enderror"
                               placeholder="Ej: 38123456"
                               value="{{ old('checkout_dni') }}">
                        @error('checkout_dni')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ── PASO 2: Tipo de entrega ────────────────────────── --}}
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header text-success fw-bold border-secondary">
                <i class="bi bi-truck me-2"></i>Tipo de entrega
            </div>
            <div class="card-body">
                <div class="d-flex gap-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo_entrega"
                               id="tipo_retiro" value="retiro"
                               {{ old('tipo_entrega', 'retiro') === 'retiro' ? 'checked' : '' }}
                               onchange="toggleEntrega()">
                        <label class="form-check-label text-white" for="tipo_retiro">
                            <i class="bi bi-shop me-1 text-success"></i> Retiro en sucursal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo_entrega"
                               id="tipo_envio" value="envio"
                               {{ old('tipo_entrega') === 'envio' ? 'checked' : '' }}
                               onchange="toggleEntrega()">
                        <label class="form-check-label text-white" for="tipo_envio">
                            <i class="bi bi-truck me-1 text-success"></i> Envío a domicilio
                        </label>
                    </div>
                </div>
                @error('tipo_entrega')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror

                {{-- Mensaje retiro en sucursal --}}
                <div id="bloque-retiro" style="{{ old('tipo_entrega') === 'envio' ? 'display:none' : '' }}">
                    <div class="alert alert-secondary border-secondary text-white-50 small mb-0">
                        <i class="bi bi-info-circle me-2 text-success"></i>
                        Una vez confirmado el pedido, te contactaremos al email
                        <strong class="text-white">{{ $user->email }}</strong>
                        para avisarte cuándo está listo para retirar.
                    </div>
                </div>

                {{-- Campos de domicilio --}}
                <div id="bloque-envio" style="{{ old('tipo_entrega') === 'envio' ? '' : 'display:none' }}">
                    <div class="row g-3 mt-1">
                        <div class="col-md-7">
                            <label class="form-label text-white">Calle <span class="text-danger">*</span></label>
                            <input type="text" name="envio_calle"
                                   class="form-control bg-dark text-white border-secondary @error('envio_calle') is-invalid @enderror"
                                   placeholder="Ej: Av. Rivadavia"
                                   value="{{ old('envio_calle') }}">
                            @error('envio_calle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-white">Número <span class="text-danger">*</span></label>
                            <input type="text" name="envio_numero" inputmode="numeric" maxlength="6"
                                   class="form-control bg-dark text-white border-secondary @error('envio_numero') is-invalid @enderror"
                                   placeholder="742"
                                   value="{{ old('envio_numero') }}">
                            @error('envio_numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-white">Departamento <span class="text-muted small">(opcional)</span></label>
                            <input type="text" name="envio_departamento"
                                   class="form-control bg-dark text-white border-secondary"
                                   placeholder="Ej: 3B"
                                   value="{{ old('envio_departamento') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-white">Código Postal <span class="text-danger">*</span></label>
                            <input type="text" name="envio_codigo_postal" inputmode="numeric" maxlength="4"
                                   class="form-control bg-dark text-white border-secondary @error('envio_codigo_postal') is-invalid @enderror"
                                   placeholder="3400"
                                   value="{{ old('envio_codigo_postal') }}">
                            @error('envio_codigo_postal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label text-white">Descripción adicional <span class="text-muted small">(opcional)</span></label>
                            <input type="text" name="envio_descripcion"
                                   class="form-control bg-dark text-white border-secondary"
                                   placeholder="Ej: Casa con portón verde, timbre roto"
                                   value="{{ old('envio_descripcion') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── PASO 3: Método de pago ──────────────────────────── --}}
        <div class="card bg-dark border-secondary mb-4">
            <div class="card-header text-success fw-bold border-secondary">
                <i class="bi bi-credit-card me-2"></i>Método de pago
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-3 mb-3" id="opciones-pago">

                    {{-- Mercado Pago --}}
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodo_pago"
                               id="pago_mp" value="mercadopago"
                               {{ old('metodo_pago') === 'mercadopago' ? 'checked' : '' }}
                               onchange="togglePago()">
                        <label class="form-check-label text-white" for="pago_mp">
                            <i class="bi bi-phone me-1 text-success"></i> Mercado Pago
                        </label>
                    </div>

                    {{-- Tarjeta --}}
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="metodo_pago"
                               id="pago_tarjeta" value="tarjeta"
                               {{ old('metodo_pago') === 'tarjeta' ? 'checked' : '' }}
                               onchange="togglePago()">
                        <label class="form-check-label text-white" for="pago_tarjeta">
                            <i class="bi bi-credit-card me-1 text-success"></i> Tarjeta crédito / débito
                        </label>
                    </div>

                    {{-- Efectivo (solo retiro) --}}
                    <div class="form-check" id="opcion-efectivo" style="{{ old('tipo_entrega') === 'envio' ? 'display:none' : '' }}">
                        <input class="form-check-input" type="radio" name="metodo_pago"
                               id="pago_efectivo" value="efectivo"
                               {{ old('metodo_pago') === 'efectivo' ? 'checked' : '' }}
                               onchange="togglePago()">
                        <label class="form-check-label text-white" for="pago_efectivo">
                            <i class="bi bi-cash me-1 text-success"></i> Efectivo (solo retiro)
                        </label>
                    </div>

                </div>
                @error('metodo_pago')
                    <div class="text-danger small mb-3">{{ $message }}</div>
                @enderror

                {{-- Bloque Mercado Pago --}}
                <div id="bloque-mp" style="{{ old('metodo_pago') === 'mercadopago' ? '' : 'display:none' }}">
                    <div class="alert alert-secondary border-secondary text-white-50 small">
                        <i class="bi bi-whatsapp me-2 text-success fs-5"></i>
                        Para pagar por Mercado Pago, contactanos por WhatsApp y te enviamos el link de pago:
                        <a href="https://wa.me/541124096668?text=Hola%2C+quiero+pagar+mi+pedido+de+Evolvex"
                           target="_blank"
                           class="btn btn-success btn-sm ms-2 fw-bold">
                            <i class="bi bi-whatsapp me-1"></i> Ir a WhatsApp
                        </a>
                    </div>
                </div>

                {{-- Bloque Tarjeta --}}
                <div id="bloque-tarjeta" style="{{ old('metodo_pago') === 'tarjeta' ? '' : 'display:none' }}">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label text-white">Número de tarjeta <span class="text-danger">*</span></label>
                            <input type="text" name="tarjeta_numero" inputmode="numeric"
                                   maxlength="19"
                                   class="form-control bg-dark text-white border-secondary @error('tarjeta_numero') is-invalid @enderror"
                                   placeholder="1234 5678 9012 3456"
                                   value="{{ old('tarjeta_numero') }}"
                                   oninput="formatarTarjeta(this)">
                            @error('tarjeta_numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-white">Nombre y Apellido del titular <span class="text-danger">*</span></label>
                            <input type="text" name="tarjeta_titular"
                                   class="form-control bg-dark text-white border-secondary @error('tarjeta_titular') is-invalid @enderror"
                                   placeholder="Ej: JUAN PEREZ"
                                   value="{{ old('tarjeta_titular') }}"
                                   style="text-transform: uppercase;">
                            @error('tarjeta_titular')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-white">Vencimiento (MM/AA) <span class="text-danger">*</span></label>
                            <input type="text" name="tarjeta_vencimiento" inputmode="numeric"
                                   maxlength="5"
                                   class="form-control bg-dark text-white border-secondary @error('tarjeta_vencimiento') is-invalid @enderror"
                                   placeholder="08/27"
                                   value="{{ old('tarjeta_vencimiento') }}"
                                   oninput="formatarVencimiento(this)">
                            @error('tarjeta_vencimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-white">Código de seguridad <span class="text-danger">*</span></label>
                            <input type="password" name="tarjeta_cvv" inputmode="numeric"
                                   maxlength="4"
                                   class="form-control bg-dark text-white border-secondary @error('tarjeta_cvv') is-invalid @enderror"
                                   placeholder="•••">
                            @error('tarjeta_cvv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-white">Cuotas <span class="text-danger">*</span></label>
                            <select name="tarjeta_cuotas"
                                    class="form-select bg-dark text-white border-secondary @error('tarjeta_cuotas') is-invalid @enderror">
                                <option value="">Seleccioná</option>
                                @foreach([1,3,6,12,18,24] as $cuota)
                                    <option value="{{ $cuota }}" {{ old('tarjeta_cuotas') == $cuota ? 'selected' : '' }}>
                                        {{ $cuota }} cuota{{ $cuota > 1 ? 's' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tarjeta_cuotas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Bloque Efectivo --}}
                <div id="bloque-efectivo" style="{{ old('metodo_pago') === 'efectivo' ? '' : 'display:none' }}">
                    <div class="alert alert-secondary border-secondary text-white-50 small mb-0">
                        <i class="bi bi-cash me-2 text-success"></i>
                        Abonás en efectivo al momento de retirar el pedido en nuestra sucursal.
                    </div>
                </div>

            </div>
        </div>

        {{-- Botón confirmar --}}
        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-success btn-lg fw-bold px-5">
                <i class="bi bi-check-circle me-2"></i>Confirmar pedido
            </button>
            <a href="{{ route('carrito.index') }}" class="btn btn-outline-secondary btn-lg">
                Volver al carrito
            </a>
        </div>

    </form>
</div>

<script>
    // Muestra/oculta los bloques según el tipo de entrega
    function toggleEntrega() {
        const esEnvio  = document.getElementById('tipo_envio').checked;
        document.getElementById('bloque-envio').style.display   = esEnvio ? 'block' : 'none';
        document.getElementById('bloque-retiro').style.display  = esEnvio ? 'none'  : 'block';
        document.getElementById('opcion-efectivo').style.display = esEnvio ? 'none' : '';

        // Si cambia a envío y tenía efectivo seleccionado, lo deselecciona
        if (esEnvio && document.getElementById('pago_efectivo').checked) {
            document.getElementById('pago_efectivo').checked = false;
            togglePago();
        }
    }

    // Muestra/oculta los bloques según el método de pago
    function togglePago() {
        const pago = document.querySelector('input[name="metodo_pago"]:checked')?.value;
        document.getElementById('bloque-mp').style.display       = pago === 'mercadopago' ? 'block' : 'none';
        document.getElementById('bloque-tarjeta').style.display  = pago === 'tarjeta'     ? 'block' : 'none';
        document.getElementById('bloque-efectivo').style.display = pago === 'efectivo'    ? 'block' : 'none';
    }

    // Formatea el número de tarjeta con espacios cada 4 dígitos
    function formatarTarjeta(input) {
        let valor = input.value.replace(/\D/g, '').substring(0, 16);
        input.value = valor.replace(/(.{4})/g, '$1 ').trim();
    }

    // Formatea el vencimiento como MM/AA
    function formatarVencimiento(input) {
        let valor = input.value.replace(/\D/g, '').substring(0, 4);
        if (valor.length >= 3) {
            valor = valor.substring(0, 2) + '/' + valor.substring(2);
        }
        input.value = valor;
    }

    // Inicializar estado al cargar la página (por si hay old() values)
    document.addEventListener('DOMContentLoaded', function () {
        toggleEntrega();
        togglePago();
    });
</script>
@endsection