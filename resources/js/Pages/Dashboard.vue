<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Админка" />

    <AuthenticatedLayout>
	    <div class="flex items-center justify-center h-screen">
		    <!-- Карточка для редактирования разделов -->
		    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-4">
			    <div class="bg-blue-500 text-white p-4 rounded-md">
				    <h3 class="text-xl font-semibold mb-2">Редактирование разделов</h3>
				    <!-- Добавьте здесь ссылку на страницу редактирования разделов -->
				    <a href="/dashboard/category" class="text-white hover:underline">Перейти</a>
			    </div>
		    </div>

		    <!-- Карточка для редактирования авторов -->
		    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-4">
			    <div class="bg-green-500 text-white p-4 rounded-md">
				    <h3 class="text-xl font-semibold mb-2">Редактирование авторов</h3>
				    <!-- Добавьте здесь ссылку на страницу редактирования авторов -->
				    <a href="/dashboard/author" class="text-white hover:underline">Перейти</a>
			    </div>
		    </div>

		    <!-- Карточка для редактирования книг -->
		    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-4 mb-4">
			    <div class="bg-orange-500 text-white p-4 rounded-md">
				    <h3 class="text-xl font-semibold mb-2">Редактирование книг</h3>
				    <!-- Добавьте здесь ссылку на страницу редактирования книг -->
				    <a href="/dashboard/book" class="text-white hover:underline">Перейти</a>
			    </div>
		    </div>

		    <!-- Добавьте дополнительные карточки по аналогии -->
	    </div>

    </AuthenticatedLayout>
</template>
