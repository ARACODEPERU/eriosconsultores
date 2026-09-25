{{--
    JS compartido por los formularios de lead de la landing de curso
    (modal "Resolver mis consultas" de la sección de inversión y formulario de
    brochure). Se incluye desde varios componentes pero sólo se ejecuta una vez.
--}}
<script>
    (function () {
        if (window.ercClLeadReady) return;
        window.ercClLeadReady = true;

        function withSwal(callback) {
            if (window.Swal) { callback(); return; }

            var script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            script.onload = callback;
            script.onerror = callback;
            document.head.appendChild(script);
        }

        function closeModal(modal) {
            if (!modal) return;

            if (window.jQuery && window.jQuery.fn.modal) {
                window.jQuery(modal).modal('hide');
            } else {
                modal.classList.remove('show');
                modal.style.display = 'none';
            }

            document.querySelectorAll('.modal-backdrop').forEach(function (backdrop) { backdrop.remove(); });
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        }

        document.addEventListener('submit', function (event) {
            var form = event.target.closest('[data-erc-cl-lead]');
            if (!form) return;

            event.preventDefault();

            var feedback = form.querySelector('[data-erc-cl-feedback]');
            var submit = form.querySelector('[data-erc-cl-submit]');
            var fullName = (form.querySelector('[name="full_name"]') || {}).value || '';
            var phone = (form.querySelector('[name="phone"]') || {}).value || '';
            var email = (form.querySelector('[name="email"]') || {}).value || '';
            var country = form.querySelector('[name="country_phone"]');
            var prefix = country ? country.value : '+51';

            var errors = [];

            if (fullName.trim() === '') errors.push('Ingresa tu nombre completo.');
            if (!/^[0-9]+$/.test(phone.replace(/\s/g, ''))) {
                errors.push('El teléfono solo debe contener números.');
            } else if (phone.replace(/\s/g, '').length < 8) {
                errors.push('El teléfono debe tener al menos 8 dígitos.');
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim())) {
                errors.push('Ingresa un correo electrónico válido.');
            }

            if (feedback) {
                feedback.innerHTML = errors.length ? errors.join('<br>') : '';
            }

            if (errors.length) return;

            var data = new FormData(form);
            var countryCode = prefix.replace(/[^0-9]/g, '');
            var digits = phone.replace(/[^0-9]/g, '');

            // Evita duplicar el código de país dentro del número.
            while (countryCode.length && digits.indexOf(countryCode) === 0) {
                digits = digits.substring(countryCode.length);
            }

            data.set('phone', prefix + digits);

            // Trazabilidad de campaña (si algún script del sitio la guardó).
            try {
                var tracking = JSON.parse(localStorage.getItem('traffic_tracking') || '{}');
                ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'utm_id', 'fbclid', 'gclid', 'referer', 'landing_url', 'traffic_source'].forEach(function (key) {
                    if (tracking[key]) data.set(key, tracking[key]);
                });
            } catch (error) { /* sin trazabilidad */ }

            if (submit) {
                submit.disabled = true;
                submit.style.opacity = 0.6;
            }

            fetch(form.getAttribute('data-endpoint'), {
                method: 'POST',
                body: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': (form.querySelector('[name="_token"]') || {}).value || ''
                }
            }).then(function (response) {
                return response.json().then(function (payload) {
                    return { ok: response.ok, payload: payload };
                });
            }).then(function (result) {
                if (submit) {
                    submit.disabled = false;
                    submit.style.opacity = 1;
                }

                if (!result.ok) {
                    var message = 'No pudimos registrar tus datos. Inténtalo nuevamente.';

                    if (result.payload && result.payload.errors) {
                        message = Object.keys(result.payload.errors).map(function (field) {
                            return result.payload.errors[field].join(', ');
                        }).join('<br>');
                    }

                    if (feedback) feedback.innerHTML = message;
                    return;
                }

                if (feedback) feedback.innerHTML = '';

                closeModal(form.closest('.modal'));

                withSwal(function () {
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registro exitoso',
                            text: 'Hemos recibido tu información. Un asesor se comunicará contigo por WhatsApp.',
                            confirmButtonColor: '#004aad'
                        });
                    }
                });
            }).catch(function () {
                if (submit) {
                    submit.disabled = false;
                    submit.style.opacity = 1;
                }
                if (feedback) feedback.innerHTML = 'No pudimos enviar tu información. Inténtalo nuevamente.';
            });
        });
    })();
</script>
