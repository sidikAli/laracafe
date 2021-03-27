<template>
  <div class="cart">
    
    <Navbar :updateCart="carts" />

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
              <li class="breadcrumb-item active" aria-current="page">cart</li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <h2>cart</h2>
          <div class="table-responsive mt-3">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Makanan</th>
                  <th>Keterangan</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(cart, index) in carts" :key="cart.id">
                  <td>{{ index + 1 }}</td>
                  <td>
                    <img :src="'/img/foods/' + cart.food.image" class="img-fluid shadow" width="200">
                  </td>
                  <td>{{ cart.food.name }}</td>
                  <td>{{ cart.keterangan ? cart.keterangan : "-" }}</td>
                  <td>{{ cart.jumlah_pesan }}</td>
                  <td>{{ cart.food.price }}</td>
                  <td>{{ cart.food.price * cart.jumlah_pesan }}</td>
                  <td class="text-danger">
                    <i class="fas fa-trash" @click="deleteCart(cart.id)"></i>
                  </td>
                </tr>

                <tr>
                  <td colspan="6" align="right">Total Harga: </td>
                  <td><strong>{{ totalHarga }}</strong></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Checkout -->
      <div class="row justify-content-end">
        <div class="col-md-4">
          <form class="mt-4" v-on:submit.prevent>
            <div class="form-group">
                <label for="nama">Nama : </label>
                <input type="text" class="form-control" name="nama" v-model="pesan.nama">
            </div>
            <div class="form-group">
                <label for="noMeja">No Meja :</label>
                <input type="number" class="form-control" name="no_meja" v-model="pesan.no_meja">
            </div>
            <button class="btn btn-success float-right mt-3" @click="checkout"><i class="fas fa-shopping-cart"></i> Pesan</button>
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
  name: 'cart',
  components: {
    Navbar
  },
  data() {
    return {
      carts: [],
      pesan: {}
    }
  },
  methods: {
    setCarts(data) {
      this.carts = data;
    },
    deleteCart(id) {
      axios
      .delete('http://' + window.location.hostname + '/api/carts/' + id)
      .then( () => {

        this.$toast.success('Pesanan Berhasil Dihapus.', {
            position: 'top-right',
            duration: 3000,
            dismissible: true,
        });

        // Update cart
        axios
        .get('http://' + window.location.hostname + '/api/carts/')
        .then( (response) => this.setCarts(response.data) )
        .catch( (error) => console.log(error) )

      })
      .catch( (error) => console.log(error) )

    },
    checkout() {
      if (this.carts.length < 1) {
        this.$toast.error('Keranjang Masih Kosong.', {
          position: 'top-right',
          duration: 3000,
          dismissible: true,
        });
        return;
      }

      if (this.pesan.nama && this.pesan.no_meja ) {
        axios
          .post('http://' + window.location.hostname + '/api/orders', this.pesan)
          .then( () => {
              this.$router.push({path: "/pesanan-sukses"})
              this.$toast.success('Berhasil Pesan.', {
                  position: 'top-right',
                  duration: 3000,
                  dismissible: true,
              })
          })
          .catch( (err) => console.log(err) )
      } 
      else {
        this.$toast.error('Nama dan Nomor Meja Harus Diisi.', {
            position: 'top-right',
            duration: 3000,
            dismissible: true,
        });
      }
    }
  },
  mounted() {
    axios
      .get('http://' + window.location.hostname + '/api/carts/')
      .then( (response) => this.setCarts(response.data) )
      .catch( (error) => console.log(error) )
  },
  computed: {
    totalHarga() {
      return this.carts.reduce( function (items, data) {
        return items + (data.food.price*data.jumlah_pesan);
      }, 0)
    }
  }

}
</script>
