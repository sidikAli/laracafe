<template>
	<div class="index">
		<Navbar />
		
		<div class="container">
			<div class="hero">
		      <div class="d-none d-md-block">
		        <div class="row mt-4">
		          <div class="col">
		            <div class="d-flex h-100">
		              <div class="align-self-center">
		                  <h2><strong>Delicious Foods</strong> <br> In Your Gadget</h2>
		                  <p>Ayo Segera Pilih & Pesan Makanan Favorit Anda!</p>
		                  <router-link to="/foods" class="btn btn-success btn-lg"><i class="fas fa-arrow-right"></i> Pesan</router-link>
		              </div>
		            </div>
		          </div>
		          <div class="col">
		            <img src="img/hero.png" width="100%">
		          </div>
		        </div>
		      </div>

		      <div class="d-md-none d-sm-block">
		        <div class="row mt-4">
		          <div class="col-md-6 mb-4">
		            <img src="img/hero.png" width="100%">
		          </div>
		          <div class="col-md-6">
		            <div class="d-flex h-100">
		              <div class="align-self-center">
		                  <h2><strong>Delicious Foods</strong> <br> In Your Gadget</h2>
		                  <p>Ayo Segera Pilih & Pesan Makanan Favorit Anda!</p>
		                  <button class="btn btn-success btn-lg"><i class="fas fa-arrow-right"></i> Pesan</button>
		              </div>
		            </div>
		          </div>
		        </div>
		       </div>
		      </div>

		      <div class="d-flex justify-content-between mt-5">
		        <div>
		           <h2>Best <strong>Foods</strong> </h2>
		        </div>
		        <div>
		            <router-link to="/foods" class="btn btn-success float-right"><i class="fas fa-eye"></i> Lihat Semua</router-link>
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
  name: 'Home',
  components: {
    FoodCard, Navbar
  },
  data() {
    return {
       foods: []
    }
  },
  methods: {
    setFoods(data) {
    	//only show 4 data
        this.foods = data.slice(0, 4);
    }
  },
  mounted() {
  	const url = 'http://' + window.location.hostname + '/api/foods';
    axios
      .get(url)
      .then( (response) => this.setFoods(response.data) )
      .catch( (error) => console.log(error) )
  }
}
</script>