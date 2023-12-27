<script setup>
import {Head} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import FormAddBook from "@/Components/FormAddBook.vue";
defineProps({categories: Object})

</script>


<template>
	<Head title="Добавить Книгу"/>
	<Header/>

		<div class="isolate bg-white px-6 py-10 sm:py-10 lg:px-8">
			<div class="mx-auto max-w-2xl text-center">
				<h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Добавить Книгу</h2>
			</div>
		</div>

	<FormAddBook :categories="categories" />
</template>


