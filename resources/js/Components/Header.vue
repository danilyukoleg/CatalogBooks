<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import {onMounted, reactive, ref, watch} from "vue";

const navigation = [
	{ name: 'Главная', href: '/'},
	{ name: 'Категории', href: '#', dropDown: true},
	{ name: 'Добавить Книгу', href: "/book"},
];

const userNavigation = [
	{ name: 'Мои книги', href: '/books' },
	{ name: 'Выйти', href: '/logout' },
];

const auth = [
	{name: 'Регистрация', href: '/register'},
	{name: 'Авторизация', href: '/login'}
];

const categories = ref([]);

const loadCategories = () => {
	axios.get("/api/category")
		.then(response => {
			categories.value = response.data;
		})
		.catch(error => {
			console.error(error)
		})

}

onMounted(() => {
	loadCategories();
})


const arrow = function () {
	return '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 inline-block">\n' +
	'                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>\n' +
	'                  </svg>'
};


const mobileMenu = reactive({
		isMobile: false,
		toggle: function () {
			this.isMobile = !this.isMobile;
		}
});


const isDrop = ref(false);
function openDropdown (item) {
	if (item.dropDown) {
		isDrop.value = !isDrop.value;
	}
}

const searchForm = useForm({
	search: null
})

</script>

<template>
	<div class="bg-gray-800 p-4">
		<div class="container mx-auto flex justify-between items-center">
			<!-- Логотип (ваш логотип или текст) -->
			<div class="text-white text-lg font-semibold">Логотип</div>
			<!-- Навигация -->
			<ul class="hidden md:flex space-x-4">
				<li  v-for="(item, index) in navigation" :href="item.href" :key="index">
					<template v-if="item.dropDown">
						<a  class="text-white nav-link">
							<strong  @click.prevent="openDropdown(item)" >{{ item.name }}</strong>
							<span v-html="arrow()" v-if="item.dropDown"  class="w-4 h-4 inline-block"></span>
						</a>
						<ul class="absolute z-10 mt-2 bg-white border rounded-lg shadow-md" v-if="item.dropDown" v-show="isDrop">
							<li  class="py-2 px-4 hover:bg-gray-200" v-for="category in categories" :key="category.id">
								<a :href="`/category/${category.slug}`">{{ category.name }}</a>
							</li>
						</ul>
					</template>
					<template v-else>
						<a :href="item.href"  class="text-white nav-link">
							<strong>{{ item.name }}</strong>
						</a>
					</template>
				</li>
			</ul>

			<div class="relative  w-100 max-w-md">
				<input
					v-model="searchForm.search"
					type="text"
					class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-full text-sm focus:outline-none"
					placeholder="Поиск..."
				/>
				<form @submit.prevent="searchForm.get(`/search`)">
					<button type="submit" class="absolute right-0 top-0 mt-3 mr-4">
						<svg class="h-5 w-5 text-gray-500" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
							<path d="M21 21l-5-5M11 5a6 6 0 100 12 6 6 0 000-12z"></path>
						</svg>
					</button>
				</form>
			</div>

			<!-- Ссылки на вход и регистрацию -->
			<template v-if="$page.props.auth.user !== null">
				<div class="hidden md:flex items-center space-x-4">
					<Link v-for="(item, index) in userNavigation" :href="item.href" :key="index" class="text-white">{{ item.name }}</Link>
				</div>
			</template>

			<template v-else>
				<div class="hidden md:flex items-center space-x-4">
					<Link v-for="(item, index) in auth" :href="item.href" :key="index" class="text-white">{{ item.name }}</Link>
				</div>
			</template>
			<!-- Кнопка для мобильного меню -->
			<button @click="mobileMenu.toggle()" class="md:hidden text-white">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
				     class="h-6 w-6">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
					      d="M4 6h16M4 12h16m-7 6h7"></path>
				</svg>
			</button>
		</div>
	</div>

	<!-- Мобильное меню (по умолчанию скрыто) -->
	<template v-if="mobileMenu.isMobile">
		<div class="flex flex-col bg-gray-800 p-4 gap-2" id="mobileMenu">
			<Link v-for="(item, index) in navigation" :href="item.href" :key="index" class="text-white">{{ item.name }}</Link>
			<template v-if="$page.props.auth.user !== null">
					<Link v-for="(item, index) in userNavigation" :href="item.href" :key="index" class="text-white">{{ item.name }}</Link>
			</template>
			<template v-else>
					<Link v-for="(item, index) in auth" :href="item.href" :key="index" class="text-white">{{ item.name }}</Link>
			</template>
		</div>
	</template>
</template>

<style>
a {
	cursor: pointer;
}
</style>
