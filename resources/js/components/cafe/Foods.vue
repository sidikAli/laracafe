<template>
  <div class="foods">

    <Navbar />
    
		<div class="container">
			<div class="row mt-4 d-flex justify-content-between">
				<div class="col">
					<h2>Daftar <strong>Makanan</strong></h2>
				</div>
				<div class="col-md-3">
					<div class="input-group mb-3">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Cari Makanan..." v-model="search" @keyup="searchFood">
              <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
					</div>
				</div>
			</div>

			<div class="row mb-4">
				<div class="col-md-4 mt-4" v-for="food in foods" :key="food.id">
					<FoodCard :food="food"/>
				</div>
			</div>
		</div>

  </div>
</template>

<script>

import Navbar from './template/Navbar.vue'
import FoodCard from './template/FoodCard.vue'
import axios from "axios"

export default {
  name: 'Foods',
  components: {
    Navbar, FoodCard,
  },
  data() {
    return {
       foods: [],
       search: ''
    }
  },
  methods: {
    setFoods(data) {
        this.foods = data;
    },
    searchFood() {
        axios
         .get('http://' + window.location.hostname + '/api/foods?q=' + this.search)
         .then( (response) => this.setFoods(response.data) )
         .catch( (error) => console.log(error) )
    }
  },
  mounted() {
    axios
      .get('http://' + window.location.hostname + '/api/foods')
      .then( (response) => this.setFoods(response.data) )
      .catch( (error) => console.log(error) )
  }
}
</script>