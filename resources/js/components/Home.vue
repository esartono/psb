<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary">
            <h3 class="card-title">Data Pendaftaran</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-bordered table-hover">
              <col width="250" />
              <col width="100" />
              <col width="100" />
              <thead>
                <tr>
                  <th rowspan="2" class="align-middle">Unit</th>
                  <th rowspan="2" class="align-middle">Gelombang</th>
                  <th rowspan="2" class="align-middle">Kuota</th>
                  <th colspan="3">Total</th>
                  <th colspan="3">Baru</th>
                  <th colspan="3">Aktif</th>
                </tr>
                <tr>
                  <th>L</th>
                  <th>P</th>
                  <th>Total</th>
                  <th>L</th>
                  <th>P</th>
                  <th>Total</th>
                  <th>L</th>
                  <th>P</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="unit in units" :key="unit.id">
                  <td class="text-center">{{ unit.unitnya.name }}</td>
                  <td class="text-center">{{ unit.name }}</td>
                  <th>{{ unit.kuota }}</th>
                  <th>{{ unit.jlhrekap.lbaru + unit.jlhrekap.laktif }}</th>
                  <th>{{ unit.jlhrekap.pbaru + unit.jlhrekap.paktif }}</th>
                  <th>{{ unit.jlhrekap.lbaru + unit.jlhrekap.laktif + unit.jlhrekap.pbaru + unit.jlhrekap.paktif}}</th>
                  <th>{{ unit.jlhrekap.lbaru }}</th>
                  <th>{{ unit.jlhrekap.pbaru }}</th>
                  <th>{{ unit.jlhrekap.lbaru + unit.jlhrekap.pbaru }}</th>
                  <th>{{ unit.jlhrekap.laktif }}</th>
                  <th>{{ unit.jlhrekap.paktif }}</th>
                  <th>{{ unit.jlhrekap.laktif + unit.jlhrekap.paktif }}</th>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      units: {},
    };
  },
  
  props: ['userId'],

  mounted() {
    axios
      .get("../api/gelombangs")
      .then(({ data }) => (this.units = data));
  }
};
</script>
