<script setup>
  import axios from 'axios';
  import { onMounted, ref } from 'vue';
  import { useRouter } from "vue-router"

  let products = ref([])
  const router = useRouter()

  onMounted(async() => {
    // get all products READ
    getProducts()
  })

  // READ
  const getProducts = async() => {
    let response = await axios.get('api/get_all_product')
    console.log('products: ', response);
    products.value = response.data.products
  }

  const newProduct = () => {
    router.push('/product/new')
  }

  // get images
  const ourImage = (img) => {
    return "/upload/"+img
  }

  // UPDATE
  const onEdit = (id) => {
    router.push('/product/edit/'+id)
  }

  // DELETE
  const deleteProduct = (id) => {
    Swal.fire({
      title: 'Are you sure ?',
      text: "You can't go back",
      icon: 'Warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it',
      cancelButtonText: 'NO!',
    })
    .then((result) => {
      if (result.value) {
        axios.get('/api/delete_product/'+id)
          .then(() => {
            Swal.fire(
              'Delete',
              'Product delete successfully',
              'success'
            )
            getProducts()
          })
          .catch(() => {
            Swal.fire("Failed!", "There was something wrong.", "Warning")
          })
      }
    })
  }
</script>


<template>
  <div class="container">
    <div class="products__list table my-3">
      <div
        class="
          customers__titlebar
          dflex
          justify-content-between
          align-items-center
        "
      >
        <div class="customers__titlebar--item">
          <h1 class="my-1">Products</h1>
        </div>
        <div class="customers__titlebar--item">
          <button class="btn btn-secondary my-1" @click="newProduct">Add Product</button>
        </div>
      </div>

      <div
        class="table--heading mt-2 products__list__heading"
        style="padding-top: 20px; background: #fff"
      >
        <!-- <p class="table--heading--col1">&#32;</p> -->
        <p class="table--heading--col1">image</p>
        <p class="table--heading--col2">Product</p>
        <p class="table--heading--col4">Type</p>
        <p class="table--heading--col3">Inventory</p>
        <!-- <p class="table--heading--col5">&#32;</p> -->
        <p class="table--heading--col5">actions</p>
      </div>

      <div v-if="products.length > 0">
        <div class="table--items products__list__item" v-for="product in products" :key="product.id">
          <div class="products__list__item--imgWrapper">
            <img
              class="products__list__item--img"
              v-if="product.photo"
              style="height: 40px"
              :src="ourImage(product.photo)"
            />
          </div>
          <a href="# " class="table--items--col2">{{ product.name }}</a>
          <p class="table--items--col2">{{ product.type }}</p>
          <p class="table--items--col3">{{ product.quantity }}</p>
          <div>
            <button class="btn-icon btn-icon-success" @click="onEdit(product.id)">
              <i class="fas fa-pencil-alt"></i>
            </button>
            <button class="btn-icon btn-icon-danger" @click="deleteProduct(product.id)">
              <i class="far fa-trash-alt"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="table--items products__list__item" v-else>
        <p>Product not found</p>
      </div>
    </div>
  </div>
</template>