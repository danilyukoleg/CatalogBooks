<script setup>
import {Head, Link, router} from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";

import {useForm} from "@inertiajs/vue3";
import ButtonAdmin from "@/Components/ButtonAdmin.vue";
import {reactive, ref} from "vue";

defineProps({categories: Object});


const form = useForm({
	name:  null,
	slug: null,
	description: null
})


const formUpdate = useForm({
	name:  null,
	slug: null,
	description: null
})

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


const edit = reactive({
    isBtnUpdate: false,
    number: null,
    toggle: function (index) {
        this.isBtnUpdate = !this.isBtnUpdate;
        this.number = index;
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



const editForm = function (slug) {
	router.get(`/dashboard/category/${slug}/edit`, formUpdate);
}

const deleteDorm = function (slug) {
    router.delete(`/dashboard/category/${slug}`);
}

const hidden = ref(false);

function hideShow () {
    hidden.value = true;
}

function hideFunc () {
    hidden.value = false;
}

const hideForm = function (slug) {
	router.patch(`/dashboard/category/${slug}`, {hidden: hidden.value});
}
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
				<h2 class="text-2xl font-bold mb-4 text-center mt-10">Добавление раздела</h2>
				<form @submit.prevent="form.get('/dashboard/category/create')" method="get" class="max-w-md m-auto">
					<div class="mb-4">
						<label for="section_name" class="block text-sm font-medium text-gray-600">Название раздела:</label>
						<input v-model="form.name" type="text" name="name" id="name" class="mt-1 p-2 border rounded-md w-full">
						<span v-if="$page.props.errors.name" class="text-red-500 text-sm">{{ $page.props.errors.name }}</span>
					</div>
					<div class="mb-4">
						<label for="section_name" class="block text-sm font-medium text-gray-600">Слаг:</label>
						<input v-model="form.slug" type="text" name="slug" id="slug" class="mt-1 p-2 border rounded-md w-full">
						<span v-if="$page.props.errors.slug" class="text-red-500 text-sm">{{ $page.props.errors.slug }}</span>
					</div>
					<div class="mb-4">
						<label for="section_description" class="block text-sm font-medium text-gray-600">Описание раздела:</label>
						<textarea v-model="form.description" name="description" id="description" class="mt-1 p-2 border rounded-md w-full"></textarea>
						<span v-if="$page.props.errors.description" class="text-red-500 text-sm">{{ $page.props.errors.description }}</span>
					</div>
					<div>
						<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Создать раздел</button>
					</div>
				</form>
			</template>
			<template v-if="create.isBtn">
				<div class="overflow-x-auto">
					<table class="min-w-full bg-white border border-gray-300">
						<thead>
						<tr>
							<th class="py-2 px-4 border-b">Название</th>
							<th class="py-2 px-4 border-b">Слаг</th>
							<th class="py-2 px-4 border-b">Описание</th>
							<th class="py-2 px-4 border-b">Действия</th>
						</tr>
						</thead>
						<tbody>
							<tr v-for="(category, index) in categories" :key="category.id">
								<td class="py-2 px-4 border-b">
									<p v-show="edit.number !== index" >{{ category.name }}</p>
									<template v-if="edit.isBtnUpdate && edit.number === index">
										<input
											v-model="formUpdate.name"
											type="text"
											id="name"
											:name="formUpdate.name"
											class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 w-200"
										/>
									</template>
								</td>
								<td class="py-2 px-4 border-b">
									<p v-show="edit.number !== index">{{ category.slug }}</p>
									<template v-if="edit.isBtnUpdate && edit.number === index">
										<input
											v-model="formUpdate.slug"
											type="text"
											id="slug"
											:name="formUpdate.slug"
											class=
												"mt-1 p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 w-200"
										/>
									</template>
								</td>
								<td class="py-2 px-4 border-b">
									<p v-show="edit.number !== index">{{ category.description }}</p>
									<template v-if="edit.isBtnUpdate && edit.number === index">
										<textarea v-model="formUpdate.description" :name="formUpdate.description" class="mt-1 p-2 border rounded-md w-full resize-none focus:outline-none focus:border-blue-500">
										</textarea>
									</template>
								</td>
								<td class="py-2 px-4 border-b flex justify-center">
									<template v-if="edit.number !== index">
										<button @click="edit.toggle(index)"  type="submit" class="bg-blue-500 text-white py-1 px-2 rounded-md mr-2">Изменить</button>
									</template>
									<template v-if="edit.isBtnUpdate && edit.number === index">
										<form @submit.prevent="editForm(category.slug)" method="get">
											<button  type="submit" class="bg-blue-500 text-white py-1 px-2 rounded-md mr-2">Обновить</button>
										</form>
									</template>

									<form @submit.prevent="deleteDorm(category.slug)">
										<button class="bg-red-500 text-white py-1 px-2 rounded-md mr-2">Удалить </button>
									</form>
									<form @submit.prevent="hideForm(category.slug)">
										<button @click="hideFunc" type="submit" v-if="category.hide === '1' || category.hide === null" class="bg-gray-500 text-white py-1 px-2 rounded-md">Скрыть</button>
										<button @click="hideShow" type="submit" v-else class="bg-gray-500 text-white py-1 px-2 rounded-md">Показать</button>
									</form>
								</td>
							</tr>

						</tbody>
					</table>
				</div>

			</template>
		</div>


</template>
<style>
</style>
