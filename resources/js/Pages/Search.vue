<script setup>
import { Head } from '@inertiajs/vue3';
import Header from "@/Components/Header.vue";

defineProps({books: Object, slug: String})
</script>

<template>
	<Head :title="`Поиск - ${slug}`"/>
	<Header />
	<template v-if="books.length !== 0">
		<h1 class="text-4xl font-bold text-center text-gray-800 mb-6 mt-5"> Вы искали - {{ slug }}</h1>
	</template>
	<template v-else>
		<h1 class="text-4xl font-bold text-center text-gray-800 mb-6 mt-5"> Ничего не найдено</h1>
	</template>
	<template v-if="books.length !== 0">
		<div class="container m-auto mt-10 mb-20">
			<ul class="grid place-items-center gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">

				<li class="bg-white p-4 rounded-md shadow-md" v-for="book in books" :key="book.id">
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
		</div>
	</template>
</template>

