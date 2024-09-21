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
              <thead>
                <tr>
                  <th rowspan="2" class="align-middle">Unit</th>
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
              <thead>
                <tr>
                  <th rowspan="2" class="align-middle">Unit</th>
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
        <div class="card border-danger">
          <div class="card-header bg-danger">
            <h3 class="card-title">Data Kesediaan Ikut Impruf</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-bordered table-hover">
              <col width="250" />
              <col width="100" />
              <thead>
                <tr>
                  <th class="align-middle">Unit</th>
                  <th class="align-middle">NULL</th>
                  <th class="align-middle">BELUM BERSEDIA</th>
                  <th class="align-middle">BULANAN</th>
                  <th class="align-middle">TAHUNAN</th>
                  <th class="align-middle">TOTAL</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">SMPIT Nurul Fikri	</td>
                  <th>{{ impruf['null']['smp'] }}</th>
                  <th>{{ impruf['belum']['smp'] }}</th>
                  <th>{{ impruf['bulanan']['smp'] }}</th>
                  <th>{{ impruf['tahunan']['smp'] }}</th>
                  <th>{{ impruf['total']['smp'] }}</th>
                </tr>
                <tr>
                  <td class="text-center">SMAIT Nurul Fikri	</td>
                  <th>{{ impruf['null']['sma'] }}</th>
                  <th>{{ impruf['belum']['sma'] }}</th>
                  <th>{{ impruf['bulanan']['sma'] }}</th>
                  <th>{{ impruf['tahunan']['sma'] }}</th>
                  <th>{{ impruf['total']['sma'] }}</th>
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
              <thead>
                <tr>
                  <th rowspan="3" class="align-middle">Unit</th>
                  <th colspan="3" rowspan="2" class="align-middle">TOTAL</th>
                  <th colspan="9">Kategori</th>
                </tr>
                <tr>
                  <th colspan="3">Umum</th>
                  <th colspan="3">SIT NF</th>
                  <th colspan="3">Pegawai</th>
                </tr>
                <tr>
                  <th>L</th>
                  <th>P</th>
                  <th class="bg-yellow align-middle">TOTAL</th>
                  <th>L</th>
                  <th>P</th>
                  <th class="bg-yellow align-middle">TOTAL</th>
                  <th>L</th>
                  <th>P</th>
                  <th class="bg-yellow align-middle">TOTAL</th>
                  <th>L</th>
                  <th>P</th>
                  <th class="bg-yellow align-middle">TOTAL</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="!units.length">
                  <th colspan="6" class="text-center">No Data</th>
                </tr>
                <tr v-for="unit in units" :key="unit.id">
                  <td class="text-center">{{ unit.unitnya.name }}</td>
                  <th>{{ unit.jlhrekap.lumumdaul + unit.jlhrekap.lnfdaul + unit.jlhrekap.lpegdaul }}</th>
                  <th>{{ unit.jlhrekap.pumumdaul + unit.jlhrekap.pnfdaul + unit.jlhrekap.ppegdaul }}</th>
                  <th class="bg-yellow">{{ unit.jlhrekap.lumumdaul + unit.jlhrekap.lnfdaul + unit.jlhrekap.lpegdaul + unit.jlhrekap.pumumdaul + unit.jlhrekap.pnfdaul + unit.jlhrekap.ppegdaul }}</th>
                  <th>{{ unit.jlhrekap.lumumdaul }}</th>
                  <th>{{ unit.jlhrekap.pumumdaul }}</th>
                  <th class="bg-yellow">{{ unit.jlhrekap.lumumdaul + unit.jlhrekap.pumumdaul }}</th>
                  <th>{{ unit.jlhrekap.lnfdaul }}</th>
                  <th>{{ unit.jlhrekap.pnfdaul }}</th>
                  <th class="bg-yellow">{{ unit.jlhrekap.lnfdaul + unit.jlhrekap.pnfdaul }}</th>
                  <th>{{ unit.jlhrekap.lpegdaul}}</th>
                  <th>{{ unit.jlhrekap.ppegdaul}}</th>
                  <th class="bg-yellow">{{ unit.jlhrekap.lpegdaul + unit.jlhrekap.ppegdaul }}</th>
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
      impruf: [],
    };
  },
  
  props: ['userId'],

  mounted() {
    axios
      .get("../api/gelombangs")
      .then(({ data }) => (this.units = data));
      axios
      .get("../api/gelImpruf")
      .then(({ data }) => (this.impruf = data));
  }
};
</script>
