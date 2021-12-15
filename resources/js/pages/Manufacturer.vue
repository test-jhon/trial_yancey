<script>
export default {
  data() {
    return {
      reqBody: {},
      modalShow: false,
      manufacturers: {},
    }
  },
  created() {
    this.getManufacturers();
  },
  methods: {
    async openModal(event) {
      switch (event) {
        case 'CreateManufacturer':
          this.reqBody = {
            manufacturer: '',
          }
          this.modalShow = true
          break
      }
    },
    getManufacturers() {
      window.axios.get('/api/manufacturers')
        .then(res => this.manufacturers = res.data)
        .catch(err => console.log(`Err: ${err}`))
    },
    createManufacturer() {
      window.axios.post('/api/manufacturers', this.reqBody)
        .then(_ => {
          alert('Successfully Added!')
          this.getManufacturers()
        })
        .catch(err => console.log(`Err: ${err}`))
    },
    removeManufacturer(data, index) {
      if (confirm(`Are you sure want to remove "${data.manufacturer}"`)) {
        window.axios.delete(`/api/manufacturers/${data.id}`)
          .then(_ => {
            alert('Successfully removed!')
            this.manufacturers.splice(index, 1)
          })
          .catch(err => console.log(`Err: ${err}`))
      }
    }
  }
}
</script>

<template>
  <div>
    <h2>List of manufacturers</h2>
    <b-button @click="openModal('CreateManufacturer')" class="mb-2 px-5">Create</b-button>
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Manufacturer</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(data, index) in manufacturers" :key="data.id">
          <th scope="row">{{ data.id }}</th>
          <td>{{ data.manufacturer }}</td>
          <td>
            <a href="#" class="text-danger" @click.prevent="removeManufacturer(data, index)">Delete</a>
          </td>
        </tr>
      </tbody>
    </table>

    <b-modal v-model="modalShow" @ok="createManufacturer" title="Add a manufacturer">
      <div class="mb-3">
        <label for="frmName" class="form-label">Name</label>
        <input type="text" class="form-control" id="frmName" v-model="reqBody.manufacturer" required>
      </div>
    </b-modal>
  </div>
</template>
