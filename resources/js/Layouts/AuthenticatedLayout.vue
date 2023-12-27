<script setup>
import { ref } from 'vue';
import Header from "@/Components/Header.vue";

</script>

<template>
	<Header/>
            <main>
                <slot />
            </main>
</template>
