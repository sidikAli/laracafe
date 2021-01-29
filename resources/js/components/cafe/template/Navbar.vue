<template>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container-fluid">
      <a class="navbar-brand" href="#">Laracafe</a>
	    <!-- <a class="navbar-brand" to="/">Laracafe</a> -->
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
	      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
	        <li class="nav-item">
	           <router-link class="nav-link" to="/">Home</router-link>
	        </li>
	        <li class="nav-item">
	          <router-link class="nav-link" to="/foods">Foods</router-link>
	        </li>
	      </ul>

	      <ul class="navbar-nav">
	      	<li class="nav-item">
            <router-link class="nav-link" to="/cart">
              <i class="fas fa-shopping-cart"></i>
              <span class="ml-2 badge badge-success">
              	{{ updateCart ? updateCart.length : jumlah_pesanan.length }}
          	  </span>
            </router-link>
          </li>
	      </ul>
	    </div>
	  </div>
    </nav>
</template>

<script>
import axios from "axios"

export default {
  name: 'Navbar',
  data() {
    return {
       jumlah_pesanan: []
    }
  },
  props : ['updateCart'],
  methods: {
    setJumlah(data) {
        this.jumlah_pesanan = data;
    }
  },
  mounted() {
    axios
      .get('http://' + window.location.hostname + '/api/carts')
      .then( (response) => this.setJumlah(response.data) )
      .catch( (error) => console.log(error) )
  }
}
</script>