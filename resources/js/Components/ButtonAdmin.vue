<script setup>
defineProps({number: Number, text: String})

const classBtn = [
	"px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue active:bg-blue-800",
	"px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 focus:outline-none focus:shadow-outline-green active:bg-green-800",
	"px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-700 focus:outline-none focus:shadow-outline-orange active:bg-orange-800",
	"px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 focus:outline-none focus:shadow-outline-red active:bg-red-800"


];
</script>

<template>

	<button :class="classBtn[number]">
		{{ text }}
	</button>


</template>

