<script setup>
defineProps({
    title: { type: String, required: true },
    description: { type: String, required: true },
})
</script>

<template>
    <main class="h-screen px-4 xl:p-0 xl:grid xl:grid-cols-2">
        <div class="flex items-center justify-center h-full">
            <div class="flex flex-col justify-center w-full h-full max-w-sm">
                <div class="mb-6 space-y-2">
                    <h1 class="text-2xl font-medium">{{ title }}</h1>
                    <p class="text-sm text-red text-content-muted">{{ description }}</p>
                </div>
                <slot />
            </div>
        </div>
        <div class="hidden m-2 rounded-md xl:block bg-primary">

        </div>
    </main>
</template>