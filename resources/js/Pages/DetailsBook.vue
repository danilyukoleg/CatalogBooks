<script setup>
import Header from "@/Components/Header.vue";
import {Head} from "@inertiajs/vue3";

defineProps({book: Object, author: Object});

</script>

<template>
	<Head :title="book.name"/>
	<Header/>

	<div class="max-w-2xl mx-auto mt-8">
		<div class="bg-white p-8 rounded-lg shadow-md">
			<h1 class="text-3xl font-bold mb-4">{{ book.name }}</h1>
			<img :src="book.cover"  :alt="book.name" class="mb-4 rounded-md m-auto">
			<p class="text-gray-700 mb-4">{{ book.description }}</p>
			<div class="flex items-center justify-between mb-4">
				<p class="text-gray-600">Год: {{ book.year }}</p>
				<p class="text-gray-600">Автор: {{ author.fio }}</p>
			</div>

		</div>
	</div>
</template>

