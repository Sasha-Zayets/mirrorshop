<template>
	<div class="logo">
		<img src="@/static/images/logo.svg" class="logo__image" alt="">
	</div>
</template>

<script>
export default {
    name: "Logo.vue"
}
</script>

<style lang="scss" scoped>
@import '~assets/sass/variables';

.logo {
	width: 230px;
	min-width: 230px;
	height: 63px;
	&__image {
		max-width: 100%;
		min-width: 100%;
		height: auto;
	}
}

@media #{$screen-min-768} {
	.logo {
		min-width: 200px;
	}
}

@media #{$screen-min-992} {
	.logo {
		min-width: 230px;
	}
}
</style>
