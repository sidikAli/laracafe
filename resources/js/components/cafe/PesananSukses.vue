<template>
  <div class="pesanan-sukses">
    <Navbar />
    <div class="container">
		<div class="row justify-content-center">
        <div class="col text-center">
            <img :src="'img/waiting.png'" width="300">
            <h2><Strong>Sukses!</Strong></h2>
            <h4>Pesanan Anda Segera diproses. <br> Selamat Menunggu</h4>
        </div>
    </div>
    </div>
  </div>
</template>

<script>
import Navbar from './template/Navbar.vue'

export default {
  name: 'PesananSukses',
  components: {
    Navbar
  }
}
</script>