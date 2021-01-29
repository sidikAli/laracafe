<template>
  <div class="food-details">
    
    <Navbar />
		<div class="container">

      <!-- Breadcrumb -->
			<div class="row mt-4">
				<div class="col">
					<nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                  <router-link to="/">Home</router-link>
              </li>
              <li class="breadcrumb-item">
                  <router-link to="/foods">Foods</router-link>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Food Detail</li>
            </ol>
          </nav>
				</div>
			</div>

      <!-- Food Details -->
      <div class="row mt-2">
          <div class="col-md-6">
              <img :src="'../storage/images/' + food.image" class="img-fluid shadow rounded">
          </div>
          <div class="col-md-6">
              <h2><strong>{{ food.name }}</strong></h2>
              <hr>
              <h2>Harga : <strong>Rp.{{ food.price }}</strong></h2>
              <form action="" v-on:submit.prevent>
                  <div class="form-group">
                      <label for="jumlah_pemesanan">Jumlah Pesan</label>
                      <input type="number" class="form-control" name="jumlah_pemesanan" v-model="order.jumlah_pesan">
                  </div>
                  <div class="form-group mb-3">
                      <label for="keterangan">Keterangan</label>
                      <textarea class="form-control" name="keterangan" placeholder="contoh : jangan pake bawang" v-model="order.keterangan"></textarea>
                  </div>
                  <button class="btn btn-success" @click="pemesanan"><i class="fas fa-shopping-cart"></i> Pesan</button>
              </form>
          </div>
      </div>
		</div>

  </div>
</template>

<script>
import Navbar from './template/Navbar.vue'
import axios from "axios"

export default {
  name: 'Foods',
  components: {
    Navbar
  },
  data() {
    return {
       food: {},
       order: {}
    }
  },
  methods: {
    setFood(data){
        this.food = data;
    },
    pemesanan(){
        if (this.order.jumlah_pesan) {
            this.order.food_id = this.food.id;
            axios
                .post("http://" + window.location.hostname + "/api/carts", this.order)
                .then( () => {
                    this.$router.push({path: "/cart"})
                    this.$toast.success('Berhasil Ditambahkan Ke keranjang.', {
                        position: 'top-right',
                        duration: 3000,
                        dismissible: true,
                    })
                })
                .catch( (err) => console.log(err) )
        }
        else {
            this.$toast.error('Harap Isi Jumlah Pesan!', {
                position: 'top-right',
                duration: 3000,
                dismissible: true,
            })
        }
    }
  },
  mounted() {
    axios
      .get('http://'+ window.location.hostname + '/api/foods/' + this.$route.params.id)
      .then( (response) => this.setFood(response.data) )
      .catch( (error) => console.log(error) )
  }
}
</script>

<style>

</style>
