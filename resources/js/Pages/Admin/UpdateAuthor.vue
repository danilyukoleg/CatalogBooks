<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";

import {useForm} from "@inertiajs/vue3";


const {user} = defineProps(['user']);

const form = useForm({
	fio: user.fio,
	email: user.email,
	comment: user.comment,
});


</script>

<template>
	<Head title="Редактирование категорий"/>
	<Header/>

	<div class="flex items-center justify-center gap-10 p-4 bg-gray-200">
		<a href="/dashboard" class="text-blue-500 hover:underline">Главная</a>
	</div>
	<template v-if="$page.props.flash.message">
		<div class="bg-green-500 text-white p-4 rounded-md shadow-md">
			<p class="font-semibold text-center">Успех!</p>
			<p class="text-center">{{ $page.props.flash.message }}</p>
		</div>
	</template>

	<div class="container m-auto mt-3.5">
		<form @submit.prevent="form.patch(`/dashboard/author/${user.id}`)">
			<div class="mb-4">
				<label for="name" class="block text-sm font-medium text-gray-700">ФИО автора</label>
				<input v-model="form.fio"  type="text" id="name" name="fio" class="mt-1 p-2 border rounded-md w-full">
			</div>

			<div class="mb-4">
				<label for="name" class="block text-sm font-medium text-gray-700">E-mail</label>
				<input v-model="form.email" type="email" id="name" name="email" class="mt-1 p-2 border rounded-md w-full">
			</div>

			<div class="mb-4">
				<label for="bio" class="block text-sm font-medium text-gray-700">Комментарий</label>
				<textarea v-model="form.comment" id="comment" name="comment" rows="4" class="mt-1 p-2 border rounded-md w-full"></textarea>
			</div>

			<button class="px-4 py-2 bg-blue-500 text-white rounded-md">Сохранить изменения</button>
		</form>
	</div>
</template>
<style>
</style>
