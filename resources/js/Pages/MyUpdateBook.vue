<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";

import {useForm} from "@inertiajs/vue3";


const {book} = defineProps(['book']);


const form = useForm({
	name: book.name,
	cover: book.cover,
	year: book.year,
	description: book.description,
});

</script>

<template>
	<Head title="Редактирование категорий"/>
	<Header/>

	<div class="flex items-center justify-center gap-10 p-4 bg-gray-200">
		<a href="/books" class="text-blue-500 hover:underline">Назад</a>
	</div>
	<template v-if="$page.props.flash.message">
		<div class="bg-green-500 text-white p-4 rounded-md shadow-md">
			<p class="font-semibold text-center">Успех!</p>
			<p class="text-center">{{ $page.props.flash.message }}</p>
		</div>
	</template>

	<div class="container m-auto mt-3.5">
		<form @submit.prevent="form.patch(`/books/${book.id}`)">
			<div class="mb-4">
				<label for="name" class="block text-sm font-medium text-gray-700">Название</label>
				<input v-model="form.name"  type="text" id="name" name="name" class="mt-1 p-2 border rounded-md w-full">
			</div>

			<div class="mb-4">
				<label for="name" class="block text-sm font-medium text-gray-700">Год</label>
				<input v-model="form.year"  type="text" id="year" name="year" class="mt-1 p-2 border rounded-md w-full">
			</div>

			<div class="mb-4">
				<label for="name" class="block text-sm font-medium text-gray-700">Обложка</label>
				<img :src="form.cover" :alt="form.name">
				<input @input="form.cover = $event.target.files[0]"  type="file" name="cover" id="image-book" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
			</div>


			<div class="mb-4">
				<label for="bio" class="block text-sm font-medium text-gray-700">Описание</label>
				<textarea v-model="form.description" id="comment" name="description" rows="4" class="mt-1 p-2 border rounded-md w-full"></textarea>
			</div>

			<button class="px-4 py-2 bg-blue-500 text-white rounded-md">Сохранить изменения</button>
		</form>
	</div>
</template>
<style>
</style>
