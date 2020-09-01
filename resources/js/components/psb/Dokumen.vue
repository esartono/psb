<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="mt-2 col-md-6">
            <div class="card card-primary card-outline">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        <i class="fas fa-user-edit"></i>
                        Form Upload Dokumen
                    </h3>
                    <div class="card-tools">
                        <a href="/psb" type="button" class="btn bg-danger btn-sm">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label">Jenis Dokumen</label>
                        <div class="col-md-6">
                            <input
                            type="text"
                            class="form-control"
                            disabled="disabled"
                            :value="unit.name"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { constants } from 'crypto';
    export default {
        data() {
            return {
                doku: {},
                form: new Form({
                    id: "",
                    jenis_doku: "",
                    file: "",
                })
            }
        },

        methods: {
            listLurahSekolah(event) {
                axios
                    .get("../api/kelurahan/" + event.target.value)
                    .then(({ data }) => (this.lurahsekolah = data))
            },


        },

        mounted() {
            axios
                .get("../api/doku")
                .then(({ data }) => (this.doku = data));
        }
    }
</script>
