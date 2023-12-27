<script setup>
import {Head} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";

defineProps({categories: Object, books: Object})

</script>

<template>
	<Head title="Книги"/>
	<Header/>

	<div class="max-w-4xl mx-auto my-8" >
		<h1 class="text-4xl font-bold text-gray-800 mb-4">{{ categories.name }}</h1>
		<p class="text-lg text-gray-600 leading-7">
			{{ categories.description }}
		</p>
	</div>

	<div class="flex justify-center gap-4 mt-2 mb-10">
		<div class=" max-w-md bg-white rounded-md overflow-hidden shadow-md" v-for="book in  books" :key="book.id">
			<img :src="book.cover" class="w-full h-48 object-cover object-center"  :alt="book.name">
			<div class="p-6">
				<h2 class="text-xl font-semibold text-gray-800">{{ book.name }}</h2>
				<p class="text-gray-600 mt-2">{{ book.description }}</p>
			</div>
			<div class="bg-gray-100 px-6 py-4">
				<a :href="`/book/${book.id}`" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
					Перейти
				</a>
			</div>
		</div>
	</div>
</template>

