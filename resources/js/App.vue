<template>
	<div id="app">
    	<router-view></router-view>
    	<Footer />
	</div>
</template>

<script>
import Footer from './components/cafe/template/Footer.vue'

export default {
  components: {
    Footer
  },
}
</script>