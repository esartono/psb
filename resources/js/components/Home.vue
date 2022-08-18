<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary">
            <h3 class="card-title">Data Pendaftaran berdasarkan Status</h3>
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
                  <th colspan="3">Total</th>
                  <th colspan="3">Baru</th>
                  <th colspan="3">Aktif</th>
                </tr>
                <tr>
                  <th>L</th>
                  <th>P</th>
                  <th class="bg-cyan">Total</th>
                  <th>L</th>
                  <th>P</th>
                  <th class="bg-cyan">Total</th>
                  <th>L</th>
                  <th>P</th>
                  <th class="bg-cyan">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="!units.length">
                  <th colspan="11" class="text-center">No Data</th>
                </tr>
                <tr v-for="unit in units" :key="unit.id">
                  <td class="text-center">{{ unit.unitnya.name }}</td>
                  <td class="text-center">{{ unit.name }}</td>
                  <th>{{ unit.jlhrekap.lbaru + unit.jlhrekap.laktif }}</th>
                  <th>{{ unit.jlhrekap.pbaru + unit.jlhrekap.paktif }}</th>
                  <th class="bg-cyan">{{ unit.jlhrekap.lbaru + unit.jlhrekap.laktif + unit.jlhrekap.pbaru + unit.jlhrekap.paktif}}</th>
                  <th>{{ unit.jlhrekap.lbaru }}</th>
                  <th>{{ unit.jlhrekap.pbaru }}</th>
                  <th class="bg-cyan">{{ unit.jlhrekap.lbaru + unit.jlhrekap.pbaru }}</th>
                  <th>{{ unit.jlhrekap.laktif }}</th>
                  <th>{{ unit.jlhrekap.paktif }}</th>
                  <th class="bg-cyan">{{ unit.jlhrekap.laktif + unit.jlhrekap.paktif }}</th>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <div class="col-md-12">
        <div class="card border-success">
          <div class="card-header bg-success">
            <h3 class="card-title">Data Pendaftaran berdasarkan Kategori</h3>
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
                  <th colspan="3">Baru</th>
                  <th rowspan="2" class="bg-green align-middle">TOTAL</th>
                  <th colspan="3">Aktif</th>
                  <th rowspan="2" class="bg-green align-middle">TOTAL</th>
                </tr>
                <tr>
                  <th>Umum</th>
                  <th>SIT NF</th>
                  <th>Pegawai</th>
                  <th>Umum</th>
                  <th>SIT NF</th>
                  <th>Pegawai</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="!units.length">
                  <th colspan="10" class="text-center">No Data</th>
                </tr>
                <tr v-for="unit in units" :key="unit.id">
                  <td class="text-center">{{ unit.unitnya.name }}</td>
                  <td class="text-center">{{ unit.name }}</td>
                  <th>{{ unit.jlhrekap.umumbaru }}</th>
                  <th>{{ unit.jlhrekap.nfbaru }}</th>
                  <th>{{ unit.jlhrekap.pegbaru}}</th>
                  <th class="bg-green">{{ unit.jlhrekap.umumbaru + unit.jlhrekap.nfbaru + unit.jlhrekap.pegbaru }}</th>
                  <th>{{ unit.jlhrekap.umumaktif }}</th>
                  <th>{{ unit.jlhrekap.nfaktif }}</th>
                  <th>{{ unit.jlhrekap.pegaktif}}</th>
                  <th class="bg-green">{{ unit.jlhrekap.umumaktif + unit.jlhrekap.nfaktif + unit.jlhrekap.pegaktif }}</th>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
            <div class="col-md-12">
        <div class="card border-warning">
          <div class="card-header bg-warning">
            <h3 class="card-title">Data Siswa yang sudah Daftar Ulang</h3>
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
                  <th colspan="3">Kategori</th>
                  <th rowspan="2" class="bg-yellow align-middle">TOTAL</th>
                </tr>
                <tr>
                  <th>Umum</th>
                  <th>SIT NF</th>
                  <th>Pegawai</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="!units.length">
                  <th colspan="6" class="text-center">No Data</th>
                </tr>
                <tr v-for="unit in units" :key="unit.id">
                  <td class="text-center">{{ unit.unitnya.name }}</td>
                  <td class="text-center">{{ unit.name }}</td>
                  <th>{{ unit.jlhrekap.umumdaul }}</th>
                  <th>{{ unit.jlhrekap.nfdaul }}</th>
                  <th>{{ unit.jlhrekap.pegdaul}}</th>
                  <th class="bg-yellow">{{ unit.jlhrekap.umumdaul + unit.jlhrekap.nfdaul + unit.jlhrekap.pegdaul }}</th>
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
