<template>
    <div class="success-icon-wrapper">
        <div class="confetti">
            <span style="--x: -90px; --delay: 0s; --color: #22c55e"></span>
            <span style="--x: -70px; --delay: 0.2s; --color: #3b82f6"></span>
            <span style="--x: -40px; --delay: 0.4s; --color: #f59e0b"></span>
            <span style="--x: -15px; --delay: 0.15s; --color: #ef4444"></span>

            <span style="--x: 15px; --delay: 0.35s; --color: #8b5cf6"></span>
            <span style="--x: 40px; --delay: 0.1s; --color: #06b6d4"></span>
            <span style="--x: 70px; --delay: 0.5s; --color: #84cc16"></span>
            <span style="--x: 90px; --delay: 0.25s; --color: #fb7185"></span>
        </div>

        <div class="success-icon">
            <i class="pi pi-check"></i>
        </div>
    </div>
</template>
<style scoped>
.success-icon-wrapper {
    position: relative;
    width: 160px;
    height: 160px;
    margin: 0 auto;
}

.success-icon {
    position: absolute;
    inset: 0;

    margin: auto;

    width: 120px;
    height: 120px;

    border-radius: 9999px;

    background: #dcfce7;
    border: 3px solid #86efac;

    display: flex;
    align-items: center;
    justify-content: center;

    z-index: 2;
}

.success-icon i {
    font-size: 56px;
    color: #16a34a;
    animation: pop 2.5s ease infinite;
}

.confetti {
    position: absolute;
    inset: 0;
}

.confetti span {
    position: absolute;

    left: 50%;
    top: 50%;

    width: 8px;
    height: 8px;

    border-radius: 999px;

    background: var(--color);

    animation: confetti 1.6s ease-out infinite;
    animation-delay: var(--delay);
}

@keyframes pop {
    0% {
        transform: scale(0.75);
        opacity: 0.5;
    }

    25% {
        transform: scale(1.08);
    }

    50% {
        transform: scale(1);
        opacity: 1;
    }

    100% {
        transform: scale(0.75);
        opacity: 0.5;
    }
}

@keyframes confetti {
    0% {
        transform: translate(0, 0) scale(0.2);

        opacity: 0;
    }

    20% {
        opacity: 1;
    }

    100% {
        transform: translate(var(--x), -70px) rotate(720deg) scale(1);

        opacity: 0;
    }
}
</style>
