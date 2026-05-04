<script setup>
import GoogleIcon from '@/icons/Google.vue';
import Loader from '@/icons/Loader.vue';
import MicrosoftIcon from '@/icons/Microsoft.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const form = useForm({
    email: null,
    password: null,
    remember: false
});

const isFormValid = computed(() => {
    return !!(form.email?.trim() && form.password?.trim());
});

const handleLogin = () => {
    if (form.processing) return;

    if (!form.email?.trim() || !form.password?.trim()) return;

    form.email = form.email?.trim();
    form.password = form.password?.trim();

    form.post('/auth/login', {
        onFinish: () => {
            form.reset('password');
        }
    })
}
</script>

<template>

    <Head title="Iniciar sesión" description="Bienvenido a Kognit, por favor completa los campos" />
    <AuthLayout title="Acceder a Kognit" description="Bienvenido a Kognit, por favor completa los campos">
        <div class="flex flex-col gap-y-4">
            <button disabled
                class="flex items-center justify-center px-2 py-2.5 text-sm gap-x-2 bg-base-300 cursor-pointer rounded-md disabled:opacity-50 disabled:cursor-not-allowed disabled:text-content-muted">
                <GoogleIcon class="size-4" />
                Iniciar sesión con Google
            </button>
            <button disabled
                class="flex items-center justify-center px-2 py-2.5 text-sm gap-x-2 bg-base-300 cursor-pointer rounded-md disabled:opacity-50 disabled:cursor-not-allowed disabled:text-content-muted">
                <MicrosoftIcon class="size-4" />
                Iniciar sesión con Microsoft
            </button>
        </div>
        <div class="flex items-center my-4">
            <span class="flex-1 h-px bg-base-400"></span>
            <span class="px-2 text-content-muted">o</span>
            <span class="flex-1 h-px bg-base-400"></span>
        </div>
        <form @submit.prevent="handleLogin" class="space-y-4">
            <div class="flex flex-col space-y-2">
                <label for="email" class="text-sm font-medium">Correo Electrónico</label>
                <input required v-model="form.email" :disabled="form.processing" autofocus type="email" name="email"
                    id="email" placeholder="example@example.com" minlength="1" maxlength="255" autocomplete="email"
                    class="px-4 py-2 text-sm border rounded-md outline-none focus-visible:ring-offset-2 focus-visible:ring-offset-base-100 focus-visible:ring-3 focus-visible:ring-primary border-base-400 placeholder:text-content-muted">
                <span v-if="form.errors.email" class="text-xs text-error">{{ form.errors.email }}</span>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="password" class="text-sm font-medium">Contraseña</label>
                <input required v-model="form.password" :disabled="form.processing" type="password" name="password"
                    id="password" placeholder="••••••••" minlength="8" autocomplete="current-password"
                    class="px-4 py-2 text-sm border rounded-md outline-none focus-visible:ring-offset-2 focus-visible:ring-offset-base-100 focus-visible:ring-3 focus-visible:ring-primary border-base-400 placeholder:text-content-muted">
                <span v-if="form.errors.password" class="text-xs text-error">{{ form.errors.password }}</span>
            </div>
            <button type="submit" :disabled="!isFormValid || form.processing"
                class="flex items-center justify-center w-full px-4 py-2 text-sm text-white border border-transparent rounded-md outline-none cursor-pointer bg-primary disabled:opacity-50 focus-visible:ring-offset-2 focus-visible:ring-offset-base-100 focus-visible:ring-3 focus-visible:ring-primary dark:text-content disabled:cursor-not-allowed">
                <Loader class="absolute size-4 animate-spin"
                    :class="{ 'opacity-100': form.processing, 'opacity-0': !form.processing }" />
                <span :class="{ 'opacity-0': form.processing, 'opacity-100': !form.processing }">Continuar</span>
            </button>
        </form>
    </AuthLayout>
</template>