@extends('layouts.app')

@section('main')

<section class="terminos-condiciones bg-black py-5"> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                
                <div class="text-center mb-5">
                    <h1 class="display-4 fw-bold text-success">Términos y Condiciones</h1>
                    <hr class="border-success opacity-50 w-25 mx-auto">
                </div>

                <div class="p-4 mb-5 bg-dark border-start border-success border-4 rounded shadow">
                    <p class="lead mb-0 text-white">
                        Al acceder a este sitio web, asumimos que aceptas estos términos y condiciones en su totalidad. 
                        <span class="text-success fw-bold">No continúes usando el sitio web Evolvex</span> si no aceptas todos los términos y condiciones establecidos en esta página. El uso de este sitio web le otorga automáticamente la condición de Usuario e implica su plena aceptación de todas las directrices incluidas.
                    </p>
                </div>

                <div class="mb-5">
                    <h3 class="text-success h4 mb-3 text-uppercase fw-bold">Sección 1 - Relación con el Usuario</h3>
                    <p class="text-white-50">
                        El presente documento regula el uso de la plataforma <strong>Evolvex</strong>. La navegación por nuestro sitio web y la adquisición de cualquiera de nuestros productos suponen la adhesión del Usuario a estas condiciones en su versión más actualizada. Evolvex se reserva el derecho de modificar estos términos en cualquier momento para adaptarlos a novedades legislativas o prácticas comerciales.
                    </p>
                </div>

                <div class="mb-5">
                    <h3 class="text-success h4 mb-3 text-uppercase fw-bold">Sección 2 - Adhesión junto con la política de privacidad</h3>
                    <p class="text-white-50">
                        El uso de este sitio web implica la adhesión a estas Condiciones de Uso y a la versión más actualizada de la <strong>Política de Privacidad de Evolvex</strong>, la cual garantiza el tratamiento seguro y confidencial de sus datos personales.
                    </p>
                </div>

                <div class="mb-5">
                    <h3 class="text-success h4 mb-3 text-uppercase fw-bold">Sección 3 - Condiciones de acceso y compromiso</h3>
                    <p class="text-white-50">
                        En general, el acceso al sitio web de Evolvex es gratuito y no requiere registro previo. Sin embargo, para concretar compras o acceder a beneficios exclusivos, el usuario puede necesitar registrarse creando una cuenta personal.
                    </p>
                    <p class="text-white-50">Al utilizar nuestro sitio web, te comprometes a:</p>
                    <ul class="list-group list-group-flush bg-transparent">
                        <li class="list-group-item bg-transparent text-white border-secondary px-0 py-2">
                            <i class="bi bi-check2-circle text-success me-2"></i> Proporcionar información veraz y actualizada en los formularios de registro y compra.
                        </li>
                        <li class="list-group-item bg-transparent text-white border-secondary px-0 py-2">
                            <i class="bi bi-check2-circle text-success me-2"></i> No utilizar el sitio con fines ilegales o no autorizados.
                        </li>
                        <li class="list-group-item bg-transparent text-white border-secondary px-0 py-2">
                            <i class="bi bi-check2-circle text-success me-2"></i> No interferir ni interrumpir la seguridad del sitio ni de los servicios ofrecidos.
                        </li>
                    </ul>
                </div>

                <div class="mb-5">
                    <h3 class="text-success h4 mb-3 text-uppercase fw-bold">Sección 4 - Devolución de envío</h3>
                    <p class="text-white-50 mb-0 italic">
                       Puedes optar por la devolución del producto siempre y cuando cumpla con las siguientes condiciones:
                    </p>
                    <ul class="list-group list-group-flush bg-transparent">
                        <li class="list-group-item bg-transparent text-white border-secondary px-0 py-2">
                            <i class="bi bi-check2-circle text-success me-2"></i> Producto muy golpeado o abollado.
                        </li>
                        <li class="list-group-item bg-transparent text-white border-secondary px-0 py-2">
                            <i class="bi bi-check2-circle text-success me-2"></i> Producto equivocado, distinto a la compra realizada.
                        </li>
                        <li class="list-group-item bg-transparent text-white border-secondary px-0 py-2">
                            <i class="bi bi-check2-circle text-success me-2"></i> Producto abierto (sello de seguridad roto o sin sello).
                        </li>
                         <li class="list-group-item bg-transparent text-white border-secondary px-0 py-2">
                            <i class="bi bi-check2-circle text-success me-2"></i> Producto vencido.
                        </li>
                         <p class="text-white-50 mb-0 italic">
                        Si al adquirir el producto notas que cumple con alguna de estas características, puedes optar por realizar la devolución del mismo. Tendrás 3 días hábiles para notificar la novedad del producto.
                       </p>
                    </ul>
                </div>

                <div class="mb-5">
                    <h3 class="text-success h4 mb-3 text-uppercase fw-bold">Sección 5 - Responsabilidad en el Consumo</h3>
                    <p class="text-white-50 mb-0 italic">
                        En <strong>Evolvex</strong> enfatizamos que los suplementos dietarios no reemplazan una dieta equilibrada ni el consejo médico profesional. Es responsabilidad del Usuario consultar con un especialista antes de iniciar cualquier protocolo de suplementación.
                    </p>
                </div>

                <div class="text-center py-4 border-top border-secondary mt-5">
                    <h5 class="text-white">Defensa de las y los consumidores</h5>
                    <p class="text-white-50 small mb-3">Para reclamos o consultas legales ante organismos oficiales, ingresá acá:</p>
                    <a href="https://autogestion.produccion.gob.ar/consumidores" target="_blank" class="btn btn-outline-success btn-lg">
                        Portal de Reclamos <i class="bi bi-box-arrow-up-right ms-2"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

