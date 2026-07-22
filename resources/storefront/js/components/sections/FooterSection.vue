<template>
    <div class="py-12 bg-dark border-b border-surface-700">
        <FooterAdvantages></FooterAdvantages>
    </div>
    <footer class="footer bg-dark">
        <div class="mx-auto max-w-8xl sm:px-4 px-10 py-4">
            <div
                class="footer-grid grid gap-3 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 pt-5 text-surface-500"
            >
                <div class="footer-brand mb-5 pb-5">
                    <HeaderLogo />

                    <p class="footer-description pb-5 pt-5">
                        Premium cars. Flexible rentals.<br />
                        Your journey, our priority.
                    </p>

                    <div class="social-links flex gap-2">
                        <a
                            href="#"
                            aria-label="Facebook"
                            class="flex h-8 w-8 items-center justify-center rounded-full text-surface-400 bg-surface-900 transition-colors duration-200 hover:bg-white hover:text-surface-900"
                        >
                            <i class="pi pi-facebook"></i>
                        </a>

                        <a
                            href="#"
                            aria-label="Instagram"
                            class="flex h-8 w-8 items-center justify-center rounded-full text-surface-400 bg-surface-900 transition-colors duration-200 hover:bg-white hover:text-surface-900"
                        >
                            <i class="pi pi-instagram"></i>
                        </a>

                        <a
                            href="#"
                            aria-label="X"
                            class="flex h-8 w-8 items-center justify-center rounded-full text-surface-400 bg-surface-900 transition-colors duration-200 hover:bg-white hover:text-surface-900"
                        >
                            <i class="pi pi-twitter"></i>
                        </a>

                        <a
                            href="#"
                            aria-label="LinkedIn"
                            class="flex h-8 w-8 items-center justify-center rounded-full text-surface-400 bg-surface-900 transition-colors duration-200 hover:bg-white hover:text-surface-900"
                        >
                            <i class="pi pi-linkedin"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-column mb-5 pb-5">
                    <h3 class="text-surface-500 text-xl pb-3">Discover</h3>

                    <ul class="flex flex-col gap-3">
                        <li>
                            <a href="/" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> Home</a
                            >
                        </li>
                        <li>
                            <a href="/fleet" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> Browse Cars</a
                            >
                        </li>
                        <li>
                            <a href="/services" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> Services</a
                            >
                        </li>
                        <li>
                            <a href="/contact" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> Contact</a
                            >
                        </li>
                        <li>
                            <a href="/faq" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> FAQ</a
                            >
                        </li>
                    </ul>
                </div>

                <div class="footer-column mb-5 pb-5">
                    <h3 class="text-surface-500 text-xl pb-3">Support & Legal</h3>

                    <ul class="flex flex-col gap-3">
                        <li>
                            <a href="/privacy-policy" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> Privacy Policy</a
                            >
                        </li>
                        <li>
                            <a href="/terms-and-conditions" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> Terms & Conditions</a
                            >
                        </li>
                        <li>
                            <a href="/cookie-policy" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> Cookie Policy</a
                            >
                        </li>
                        <li>
                            <a href="/refund-and-cancellation-policy" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> Refund & Cancellation
                                Policy</a
                            >
                        </li>
                        <li>
                            <a href="/rental-requirements" class="text-surface-400"
                                ><i class="pi pi-chevron-right mr-2"></i> Rental Requirements</a
                            >
                        </li>
                    </ul>
                </div>

                <!-- Features -->
                <div class="footer-column text-surface-500 mb-5 pb-5">
                    <h3 class="text-surface-500 text-xl pb-3">Why Choose Us</h3>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="pi pi-shield"></i>
                        </div>

                        <div>
                            <h4>Best Price Guarantee</h4>
                            <p>Find a better price? We'll match it.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="pi pi-calendar"></i>
                        </div>

                        <div>
                            <h4>Free Cancellation</h4>
                            <p>Cancel or change most bookings.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="pi pi-lock"></i>
                        </div>

                        <div>
                            <h4>Secure Booking</h4>
                            <p>Your data is safe with us.</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="pi pi-headphones"></i>
                        </div>

                        <div>
                            <h4>24/7 Customer Support</h4>
                            <p>We're here whenever you need us.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="footer-bottom grid gap-3 lg:grid-cols-3 grid-cols-1 text-surface-500 border-t border-surface-700 pt-5"
            >
                <div class="copyright flex items-center justify-center lg:justify-start">
                    © 2026 DrivenGO Car Rental. All rights reserved.
                </div>

                <div class="footer-contact flex items-center justify-center gap-3">
                    <a href="tel:+3612345678">
                        <i class="pi pi-phone"></i>
                        +36 1 234 5678
                    </a>

                    <a href="mailto:info@drivengo.com">
                        <i class="pi pi-envelope"></i>
                        info@drivengo.com
                    </a>
                </div>
                <div class="payment-logos flex gap-2 items-center justify-center lg:justify-end">
                    <span>We accept: </span>
                    <div class="flex gap-2">
                        <img :src="'/images/payment/visa_v3.svg'" class="h-12" alt="visa" />
                        <img
                            :src="'/images/payment/mastercard.svg'"
                            class="h-12"
                            alt="mastercard"
                        />
                        <img :src="'/images/payment/maestro.svg'" class="h-12" alt="maestro" />
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
<script setup>
import FooterAdvantages from '@storefront/components/modules/FooterAdvantages.vue'
import HeaderLogo from '@storefront/components/modules/HeaderLogo.vue'
</script>
<style scoped lang="scss">
.bg-dark {
    background: var(--footer-bg);
}

.footer-column h3 {
    position: relative;
    margin-bottom: 5px;

    &:after {
        content: '';
        display: block;
        height: 2px;
        width: 30px;
        background: var(--primary-color);
        margin-top: 5px;
    }
}

.footer-column a i {
    font-size: 10px;
    color: var(--primary-color);
    position: relative;
    transition: all 0.2s;
}

.footer-column a:hover i {
    transform: translate(5px, 0);
}

.footer-column .feature-item {
    display: flex;
    margin-bottom: 1rem;

    .feature-icon {
        flex: 0 0 30px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        border: 1px solid var(--primary-color);
        border-radius: 50%;

        i {
            color: var(--primary-color);
        }
    }
}

.footer-contact a i {
    color: var(--primary-color);
    margin-right: 0.5rem;
}
</style>
