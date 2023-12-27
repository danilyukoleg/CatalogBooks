<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";

import {useForm} from "@inertiajs/vue3";


defineProps({books: Object})

const form = useForm({
	fio: '',
	email: '',
	country: '',
	comment: '',
	password: '',
	password_confirmation: '',
});





const submit = () => {
	router.post(`/dashboard/author`, form);
};
</script>

<template>
	<Head title="Мои книги"/>
	<Header/>

	<template v-if="$page.props.flash.message">
		<div class="bg-green-500 text-white p-4 rounded-md shadow-md">
			<p class="font-semibold text-center">Успех!</p>
			<p class="text-center">{{ $page.props.flash.message }}</p>
		</div>
	</template>
	<div class="container  p-4  m-auto">

		<ul class="divide-y divide-gray-200">
			<li class="flex items-center py-4" v-for="book in books" :key="book.id">
				<img :src="book.cover" :alt="book.name" class="w-16 h-16 object-cover rounded mr-4">
				<div class="flex-1">
					<h3 class="text-lg font-semibold">{{ book.name }}</h3>
					<p class="text-gray-500">Год: {{ book.year }}</p>
					<p class="text-gray-500"></p>

				</div>
				<a :href="`books/${book.id}/edit`" class="px-4 py-2 bg-blue-500 text-white rounded">Редактировать</a>
				<form @submit.prevent="form.delete(`/books/${book.id}`)" class="ml-3.5">
					<button class="px-4 py-2 bg-red-500 text-white rounded-md">Удалить</button>
				</form>
			</li>
		</ul>

	</div>


</template>
<style>
</style>
