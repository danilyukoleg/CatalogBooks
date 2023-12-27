<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";

import {useForm} from "@inertiajs/vue3";
import ButtonAdmin from "@/Components/ButtonAdmin.vue";
import {reactive, ref} from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

defineProps({users: Object})

const form = useForm({
	fio: '',
	email: '',
	country: '',
	comment: '',
	password: '',
	password_confirmation: '',
});

const add = reactive({
	isBtn: sessionStorage.add === 'true',
	toggle: async function () {
		return new Promise((resolve) => {
			if (!this.isBtn) {
				this.isBtn = true;
				create.isBtn = false;
				sessionStorage.setItem("add", true);
				sessionStorage.setItem("create", false);
				resolve(true);
			} else {
				resolve(false);
			}
		});
	},
});


const create = reactive({
	isBtn: sessionStorage.add === 'false',
	toggle: async function () {
		return new Promise((resolve) => {
			if (!this.isBtn) {
				this.isBtn = true;
				add.isBtn = false;
				sessionStorage.setItem("create", true);
				sessionStorage.setItem("add", false);
				resolve(true);
			} else {
				resolve(false);
			}
		});
	},
});




const submit = () => {
	router.post(`/dashboard/author`, form);
};
</script>

<template>
	<Head title="Редактирование категорий"/>
	<Header/>

	<div class="flex items-center justify-center gap-10 p-4 bg-gray-200">
		<a href="/dashboard" class="text-blue-500 hover:underline">Главная</a>
		<ButtonAdmin @click="add.toggle()" :number="1" text="Добавить"/>
		<ButtonAdmin @click="create.toggle()" :number="2" text="Редактировать"/>
	</div>
	<template v-if="$page.props.flash.message">
		<div class="bg-green-500 text-white p-4 rounded-md shadow-md">
			<p class="font-semibold text-center">Успех!</p>
			<p class="text-center">{{ $page.props.flash.message }}</p>
		</div>
	</template>
	<div class="container  p-4  m-auto">
		<template v-if="add.isBtn">
			<h2 class="text-2xl font-bold mb-4 text-center mt-10">Добавление Автора</h2>
			<form @submit.prevent="submit">
				<div>
					<InputLabel for="fio" value="ФИО" />

					<TextInput
						id="fio"
						type="text"
						class="mt-1 block w-full"
						v-model="form.fio"
						required
						autofocus
						autocomplete="name"
					/>

					<InputError class="mt-2" :message="form.errors.fio" />
				</div>

				<div class="mt-4">
					<InputLabel for="email" value="Email" />

					<TextInput
						id="email"
						type="email"
						class="mt-1 block w-full"
						v-model="form.email"
						required
						autocomplete="username"
					/>

					<InputError class="mt-2" :message="form.errors.email" />
				</div>

				<div class="mt-4">
					<InputLabel for="country" value="Страна" />

					<TextInput
						id="contry"
						type="text"
						class="mt-1 block w-full"
						v-model="form.country"
						required
						autocomplete="country"
					/>

					<InputError class="mt-2" :message="form.errors.country" />
				</div>

				<div class="mt-4">
					<InputLabel for="comment" value="Комментарий" />

					<TextInput
						id="comment"
						type="text"
						class="mt-1 block w-full"
						v-model="form.comment"
						required
						autocomplete="comment"
					/>

					<InputError class="mt-2" :message="form.errors.comment" />
				</div>

				<div class="mt-4">
					<InputLabel for="password" value="Пароль" />

					<TextInput
						id="password"
						type="password"
						class="mt-1 block w-full"
						v-model="form.password"
						required
						autocomplete="new-password"
					/>

					<InputError class="mt-2" :message="form.errors.password" />
				</div>

				<div class="mt-4">
					<InputLabel for="password_confirmation" value="Подтверждение Пароль" />

					<TextInput
						id="password_confirmation"
						type="password"
						class="mt-1 block w-full"
						v-model="form.password_confirmation"
						required
						autocomplete="new-password"
					/>

					<InputError class="mt-2" :message="form.errors.password_confirmation" />
				</div>

				<div class="flex items-center justify-end mt-4">

					<PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
						Добавить
					</PrimaryButton>
				</div>
			</form>
		</template>
		<template v-if="create.isBtn">
			<ul class="divide-y divide-gray-200">
				<!-- Пример данных авторов (замените на реальные данные) -->
				<li v-for="user in users" :key="user.id" class="py-4 flex items-center justify-between">
					<div>
						<p class="text-lg font-semibold">{{ user.fio }}</p>
						<p class="text-gray-500">{{ user.email }}</p>
					</div>
					<a :href="`/dashboard/author/${user.id}/edit`" class="px-4 py-2 bg-blue-500 text-white rounded-md">Редактировать</a>
				</li>
			</ul>
		</template>
	</div>


</template>
<style>
</style>
