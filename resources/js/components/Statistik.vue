<template>
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card border-primary">
          <div class="card-header bg-primary">
            <h3 class="card-title">Export Data Statistik</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-4">
            <div class="row text-center">
              <div class="col-sm">
                <a href="/statistik/mentah" class="btn btn-block btn-info">Mentah (*Aktif)</a>
              </div>
              <div class="col-sm">
                <a href="/statistik/mentah_terima" class="btn btn-block btn-info">Mentah (*Diterima)</a>
              </div>
              <div class="col-sm">
                <a href="/statistik/all" class="btn btn-block btn-warning">Data ALL</a>
              </div>
              <div class="col-sm">
                <a href="/statistik/aktif" class="btn btn-block btn-warning">Data AKTIF</a>
              </div>
              <div class="col-sm">
                <a href="/statistik/impruf" class="btn btn-block btn-danger">Impruf (*Diterima)</a>
              </div>
              <div class="col-sm">
                <a href="/statistik/rapot" class="btn btn-block btn-danger">Data Rapot (*Diterima)</a>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <div class="col-md-12">
        <div class="card border-success">
          <div class="card-header bg-success">
            <h3 class="card-title">Grafik Peserta Aktif</h3>
            <div class="card-tools">
              <div class="mt-1 input-group input-group-sm float-right" style="width: 220px;">
                <div class="input-group-prepend"><span class="input-group-text">Pilih Unit :</span></div>
                <select class="form-control" v-model="unit" @change="pilihUnit()">
                  <option value="ALL">Semua Unit</option>
                  <option v-for="unitnya in units" :value="unitnya" :key="unitnya">{{ unitnya.toUpperCase()+'IT Nurul Fikri' }}</option>
                </select>
              </div>
              <div class="mt-1 input-group input-group-sm" style="width: 220px;">
                <div class="input-group-prepend"><span class="input-group-text">Interval hari : </span></div>
                <select class="form-control" v-model="harinya" @change="pilihUnit()">
                  <option value="1">1 Hari</option>
                  <option value="3">3 Hari</option>
                  <option value="7">7 Hari</option>
                  <option value="14">14 Hari</option>
                  <option value="30">30 Hari</option>
                </select>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-3">
            <div v-if="!loaded" class="sk-circle">
              <div class="sk-circle1 sk-child"></div>
              <div class="sk-circle2 sk-child"></div>
              <div class="sk-circle3 sk-child"></div>
              <div class="sk-circle4 sk-child"></div>
              <div class="sk-circle5 sk-child"></div>
              <div class="sk-circle6 sk-child"></div>
              <div class="sk-circle7 sk-child"></div>
              <div class="sk-circle8 sk-child"></div>
              <div class="sk-circle9 sk-child"></div>
              <div class="sk-circle10 sk-child"></div>
              <div class="sk-circle11 sk-child"></div>
              <div class="sk-circle12 sk-child"></div>
            </div>
            <gLine v-if="loaded" :data="chartData" :plugins="plugins" :options="options" :key="grafikReload"/>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
</template>

<script>
// import { plugins } from 'chart.js';
import ChartDataLabels from 'chartjs-plugin-datalabels';
// import { options } from 'laravel-mix';

export default {
  data: () => ({
    unit: 'ALL',
    loaded: false,
    chartData: null,
    grafikReload: 0,
    dataGrafik: [],
    units: ['ccec', 'tk', 'sd', 'smp', 'sma'],
    harinya: 3,
    plugins: [ChartDataLabels],
    options: {
      responsive: true,
      scales: {
        y: {
          type: 'linear',
          display: true,
          position: 'left',
        },
      },
      plugins: {
        datalabels: {
          backgroundColor: function(context) {
            return context.dataset.backgroundColor;
          },
          borderRadius: 4,
          color: 'white',
          font: {
            weight: 'bold'
          },
          formatter: Math.round,
          padding: 6
        },
        legend: {
          display: false
        }
      }
    }
  }),
  methods: {
    async pilihUnit() {
      this.loaded = false
      try {
        const response = await fetch('/grafikNya/'+this.harinya)
        const data = await response.json()
        this.dataGrafik = []
        if(this.unit === 'ALL') {
          this.units.forEach((u) => {
            this.dataGrafik.push(
            {
              label: 'Unit ' + u.toUpperCase() + 'IT Nurul Fikri',
              backgroundColor: data.data[u].color,
              borderColor: data.data[u].color,
              data: data.data[u].data
            })
          })
        } else {
          this.dataGrafik = [
            {
              label: 'Unit ' + this.unit.toUpperCase() + 'IT Nurul Fikri',
              backgroundColor: data.data[this.unit].color,
              borderColor: data.data[this.unit].color,
              data: data.data[this.unit].data,
            },
          ]
        }
        this.chartData = {
          labels: data.data['label'],
          datasets: this.dataGrafik
        }
        this.loaded = true
      } catch (e) {
        console.error(e)
      }
    }
  },
  async mounted () {
    await this.pilihUnit('ALL')
  }
};
</script>

<style scoped>
.sk-circle {
  margin: 100px auto;
  width: 40px;
  height: 40px;
  position: relative;
}
.sk-circle .sk-child {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
}
.sk-circle .sk-child:before {
  content: '';
  display: block;
  margin: 0 auto;
  width: 15%;
  height: 15%;
  background-color: #38c172;
  border-radius: 100%;
  -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
          animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
}
.sk-circle .sk-circle2 {
  -webkit-transform: rotate(30deg);
      -ms-transform: rotate(30deg);
          transform: rotate(30deg); }
.sk-circle .sk-circle3 {
  -webkit-transform: rotate(60deg);
      -ms-transform: rotate(60deg);
          transform: rotate(60deg); }
.sk-circle .sk-circle4 {
  -webkit-transform: rotate(90deg);
      -ms-transform: rotate(90deg);
          transform: rotate(90deg); }
.sk-circle .sk-circle5 {
  -webkit-transform: rotate(120deg);
      -ms-transform: rotate(120deg);
          transform: rotate(120deg); }
.sk-circle .sk-circle6 {
  -webkit-transform: rotate(150deg);
      -ms-transform: rotate(150deg);
          transform: rotate(150deg); }
.sk-circle .sk-circle7 {
  -webkit-transform: rotate(180deg);
      -ms-transform: rotate(180deg);
          transform: rotate(180deg); }
.sk-circle .sk-circle8 {
  -webkit-transform: rotate(210deg);
      -ms-transform: rotate(210deg);
          transform: rotate(210deg); }
.sk-circle .sk-circle9 {
  -webkit-transform: rotate(240deg);
      -ms-transform: rotate(240deg);
          transform: rotate(240deg); }
.sk-circle .sk-circle10 {
  -webkit-transform: rotate(270deg);
      -ms-transform: rotate(270deg);
          transform: rotate(270deg); }
.sk-circle .sk-circle11 {
  -webkit-transform: rotate(300deg);
      -ms-transform: rotate(300deg);
          transform: rotate(300deg); }
.sk-circle .sk-circle12 {
  -webkit-transform: rotate(330deg);
      -ms-transform: rotate(330deg);
          transform: rotate(330deg); }
.sk-circle .sk-circle2:before {
  -webkit-animation-delay: -1.1s;
          animation-delay: -1.1s; }
.sk-circle .sk-circle3:before {
  -webkit-animation-delay: -1s;
          animation-delay: -1s; }
.sk-circle .sk-circle4:before {
  -webkit-animation-delay: -0.9s;
          animation-delay: -0.9s; }
.sk-circle .sk-circle5:before {
  -webkit-animation-delay: -0.8s;
          animation-delay: -0.8s; }
.sk-circle .sk-circle6:before {
  -webkit-animation-delay: -0.7s;
          animation-delay: -0.7s; }
.sk-circle .sk-circle7:before {
  -webkit-animation-delay: -0.6s;
          animation-delay: -0.6s; }
.sk-circle .sk-circle8:before {
  -webkit-animation-delay: -0.5s;
          animation-delay: -0.5s; }
.sk-circle .sk-circle9:before {
  -webkit-animation-delay: -0.4s;
          animation-delay: -0.4s; }
.sk-circle .sk-circle10:before {
  -webkit-animation-delay: -0.3s;
          animation-delay: -0.3s; }
.sk-circle .sk-circle11:before {
  -webkit-animation-delay: -0.2s;
          animation-delay: -0.2s; }
.sk-circle .sk-circle12:before {
  -webkit-animation-delay: -0.1s;
          animation-delay: -0.1s; }

@-webkit-keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}

@keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
</style>