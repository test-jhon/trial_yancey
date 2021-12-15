<script>
export default {
  data() {
    return {
      reqBody: {},
      modalShow: false,
      cars: {},
      manufacturers: {},
      types: {},
      colors: [],
    }
  },
  created() {
    this.getCars();
  },
  methods: {
    async openModal(event) {
      switch (event) {
        case 'CreateCar':
          await this.getManufacturers();
          await this.getTypes();
          await this.getColors();
          this.reqBody = {
            name: '',
            manufacturer_id: '',
            type_id: '',
            color_id: [],
          }
          this.modalShow = true
          break
      }
    },
    getCars() {
      window.axios.get('/api/cars')
        .then(res => this.cars = res.data.data)
        .catch(err => console.log(`Err: ${err}`))
    },
    getManufacturers() {
      window.axios.get('/api/manufacturers')
        .then(res => this.manufacturers = res.data)
        .catch(err => console.log(`Err: ${err}`))
    },
    getTypes() {
      window.axios.get('/api/types')
        .then(res => this.types = res.data)
        .catch(err => console.log(`Err: ${err}`))
    },
    getColors() {
      window.axios.get('/api/colors')
        .then(res => this.colors = res.data)
        .catch(err => console.log(`Err: ${err}`))
    },
    createCar() {
      window.axios.post('/api/cars', this.reqBody)
        .then(_ => {
          alert('Successfully Added!')
          this.getCars()
        })
        .catch(err => console.log(`Err: ${err}`))
    },
    removeCar(data, index) {
      if (confirm(`Are you sure want to remove "${data.name}"`)) {
        window.axios.delete(`/api/cars/${data.id}`)
          .then(_ => {
            alert('Successfully removed!')
            this.cars.splice(index, 1)
          })
          .catch(err => console.log(`Err: ${err}`))
      }
    }
  }
}
</script>

<template>
  <div>
    <h2>List of Cars</h2>
    <b-button @click="openModal('CreateCar')" class="mb-2 px-5">Create</b-button>
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Manufacturer</th>
          <th scope="col">Type</th>
          <th scope="col">Color</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(data, index) in cars" :key="data.id">
          <th scope="row">{{ data.id }}</th>
          <td>{{ data.name }}</td>
          <td>{{ data.manufacturer }}</td>
          <td>{{ data.type }}</td>
          <td><span v-for="color in data.colors" :key="color" class="color-palette mr-1" :style="{ 'background': color }"></span></td>
          <td>
            <a href="#" class="text-danger" @click.prevent="removeCar(data, index)">Delete</a>
          </td>
        </tr>
      </tbody>
    </table>

    <b-modal v-model="modalShow" @ok="createCar" title="Add a car">
      <div class="mb-3">
        <label for="frmName" class="form-label">Name</label>
        <input type="text" class="form-control" id="frmName" v-model="reqBody.name" required>
      </div>
      <div class="mb-3">
        <label for="frmManufacturer" class="form-label">Manufacturer</label>
        <select class="form-select" id="frmManufacturer" v-model="reqBody.manufacturer_id">
          <option value="">--- Select ---</option>
          <option v-for="data in manufacturers" :key="data.id" :value="data.id">{{ data.manufacturer }}</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="frmType" class="form-label">Type</label>
        <select class="form-select" id="frmType" v-model="reqBody.type_id">
          <option value="">--- Select ---</option>
          <option v-for="data in types" :key="data.id" :value="data.id">{{ data.type }}</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="frmColor" class="form-label">Color</label>
        <select class="form-select" id="frmColor" v-model="reqBody.color_id" multiple>
          <option v-for="data in colors" :key="data.id" :value="data.id">{{ data.color }}</option>
        </select>
      </div>
    </b-modal>
  </div>
</template>

<style scoped>

.color-palette {
  display: inline-block;
  width: 15px; height: 15px;
  border-radius: 100%;
  margin-right: 5px;
}

</style>