<script setup>
import { useForm} from "@inertiajs/vue3";

defineProps({categories: Object})

const form = useForm({
	nameBook: null,
	author: null,
	date: null,
	description: null,
	imageBook: null,
	category_id: null

});

</script>

<template>
	<form @submit.prevent="form.post('/book')"  method="post" class="mx-auto mt-16 max-w-xl sm:mt-20" enctype="multipart/form-data">
		<div  class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
			<div>
				<label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">Название</label>
				<div class="mt-2.5">
					<input  v-model="form.nameBook" type="text" name="name-book" id="name-book"  class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
				<template v-if="$page.props.errors.nameBook">
					<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative" role="alert">
						<span class="block sm:inline">{{ $page.props.errors.nameBook }}</span>
					</div>
				</template>
				</div>
			</div>
			<div class="form-group">
				<label for="category_id">Выберите категорию:</label>
				<select  v-model="form.category_id" class="form-control" id="category_id" name="category_id">
					<option   v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
				</select>
			</div>

			<div class="sm:col-span-2">
				<label for="company" class="block text-sm font-semibold leading-6 text-gray-900">Год выпуска </label>
				<div class="mt-2.5">
					<input v-model="form.date" type="date" name="date" id="date" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />

					<template v-if="$page.props.errors.date">
						<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative" role="alert">
							<span class="block sm:inline">{{ $page.props.errors.date }}</span>
						</div>
					</template>
				</div>
			</div>
			<div class="sm:col-span-2">
				<label for="company" class="block text-sm font-semibold leading-6 text-gray-900">Изоображение</label>
				<div class="mt-2.5">
					<input @input="form.imageBook = $event.target.files[0]"  type="file" name="image-book" id="image-book" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />

					<template v-if="$page.props.errors.imageBook">
						<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative" role="alert">
							<span class="block sm:inline">{{ $page.props.errors.imageBook }}</span>
						</div>
					</template>
				</div>
			</div>
			<div class="sm:col-span-2">
				<label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Описание</label>
				<div class="mt-2.5">
					<textarea v-model="form.description" name="description" id="description" rows="4" class="resize-none block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />

					<template v-if="$page.props.errors.description">
						<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-1 rounded relative" role="alert">
							<span class="block sm:inline">{{ $page.props.errors.description }}</span>
						</div>
					</template>
				</div>
			</div>
		</div>
		<div class="mt-10">
			<button :disabled="form.processing"  type="submit" class="block w-full  rounded-md  bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Опубликовать</button>
		</div>
	</form>
</template>

