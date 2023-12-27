<script setup>
import { Head } from '@inertiajs/vue3';
import Header from "@/Components/Header.vue";

defineProps({books: Object})
</script>

<template>
	<Head title="Главная"/>
	<Header />

	<div class="container m-auto mt-10 mb-20">
		<ul class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">

			<li class="bg-white p-4 rounded-md shadow-md" v-for="book in books.data" :key="book.id">
				<div class="bg-gray-300 w-64 h-48 overflow-hidden m-auto">
					<img :src="book.cover" :alt="book.name" class="object-cover w-full h-full ">
				</div>

				<div>
					<h3 class="text-xl font-semibold">{{ book.name }}</h3>
					<p class="text-gray-600">Автор: {{ book.user.fio }}</p>
					<p class="text-gray-600">Год: {{ book.year }}</p>
					<a :href="`/book/${book.id}`" class="text-blue-500 hover:underline">Перейти</a>
				</div>
			</li>
		</ul>

		<div class="flex justify-center items-center mt-8">
			<nav class="flex">
				<a  :href="books['first_page_url']" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-l">Назад</a>
				<a  :href="books['next_page_url']" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-l">Вперед</a>

			</nav>
		</div>

	</div>
</template>

