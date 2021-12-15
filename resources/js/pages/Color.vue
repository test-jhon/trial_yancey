<script>
export default {
  data() {
    return {
      reqBody: {},
      modalShow: false,
      colors: {},
    }
  },
  created() {
    this.getColors();
  },
  methods: {
    async openModal(event) {
      switch (event) {
        case 'CreateColor':
          this.reqBody = {
            color: '',
          }
          this.modalShow = true
          break
      }
    },
    getColors() {
      window.axios.get('/api/colors')
        .then(res => this.colors = res.data)
        .catch(err => console.log(`Err: ${err}`))
    },
    createColor() {
      window.axios.post('/api/colors', this.reqBody)
        .then(_ => {
          alert('Successfully Added!')
          this.getColors()
        })
        .catch(err => console.log(`Err: ${err}`))
    },
    removeColor(data, index) {
      if (confirm(`Are you sure want to remove "${data.color}"`)) {
        window.axios.delete(`/api/colors/${data.id}`)
          .then(_ => {
            alert('Successfully removed!')
            this.colors.splice(index, 1)
          })
          .catch(err => console.log(`Err: ${err}`))
      }
    }
  }
}
</script>

<template>
  <div>
    <h2>List of colors</h2>
    <b-button @click="openModal('CreateColor')" class="mb-2 px-5">Create</b-button>
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Color</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(data, index) in colors" :key="data.id">
          <th scope="row">{{ data.id }}</th>
          <td>
            {{ data.color }}
            <span class="color-palette" :style="{ 'background': data.color }"></span>
          </td>
          <td>
            <a href="#" class="text-danger" @click.prevent="removeColor(data, index)">Delete</a>
          </td>
        </tr>
      </tbody>
    </table>

    <b-modal v-model="modalShow" @ok="createColor" title="Add a color">
      <div class="mb-3">
        <label for="frmName" class="form-label">Color</label>
        <input color="text" class="form-control" id="frmName" v-model="reqBody.color" required>
      </div>
    </b-modal>
  </div>
</template>

<style scoped>

.color-palette {
  display: inline-block;
  width: 15px; height: 15px;
  border-radius: 100%;
  margin-left: 5px;
}

</style>