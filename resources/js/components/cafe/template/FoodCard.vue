<template>
  <div class="card card-product shadow">
    <img class="card-img-top" :src="'/img/foods/' + food.image" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{ food.name }}</h5>
      <p class="card-text">Harga Rp. {{ food.price }}</p>
      <router-link href="#" class="btn btn-success float-right" :to="'foods/' + food.id">Pesan</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'FoodCard',
  props: ['food']
}
</script>

<style>

</style>
