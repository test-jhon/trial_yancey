<script>
export default {
  data() {
    return {
      reqBody: {},
      modalShow: false,
      types: {},
    }
  },
  created() {
    this.getTypes();
  },
  methods: {
    async openModal(event) {
      switch (event) {
        case 'CreateType':
          this.reqBody = {
            type: '',
          }
          this.modalShow = true
          break
      }
    },
    getTypes() {
      window.axios.get('/api/types')
        .then(res => this.types = res.data)
        .catch(err => console.log(`Err: ${err}`))
    },
    createType() {
      window.axios.post('/api/types', this.reqBody)
        .then(_ => {
          alert('Successfully Added!')
          this.getTypes()
        })
        .catch(err => console.log(`Err: ${err}`))
    },
    removeType(data, index) {
      if (confirm(`Are you sure want to remove "${data.type}"`)) {
        window.axios.delete(`/api/types/${data.id}`)
          .then(_ => {
            alert('Successfully removed!')
            this.types.splice(index, 1)
          })
          .catch(err => console.log(`Err: ${err}`))
      }
    }
  }
}
</script>

<template>
  <div>
    <h2>List of types</h2>
    <b-button @click="openModal('CreateType')" class="mb-2 px-5">Create</b-button>
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Type</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(data, index) in types" :key="data.id">
          <th scope="row">{{ data.id }}</th>
          <td>{{ data.type }}</td>
          <td>
            <a href="#" class="text-danger" @click.prevent="removeType(data, index)">Delete</a>
          </td>
        </tr>
      </tbody>
    </table>

    <b-modal v-model="modalShow" @ok="createType" title="Add a type">
      <div class="mb-3">
        <label for="frmName" class="form-label">Type</label>
        <input type="text" class="form-control" id="frmName" v-model="reqBody.type" required>
      </div>
    </b-modal>
  </div>
</template>
