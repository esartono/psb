<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-info">
                    <form @submit.prevent="updateData()">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Lembar Persetujuan</h3>
                        </div>
                        <div class="card-body p-0">
                            <froala id="edit" :tag="'textarea'" v-model="form.agreement"></froala>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                agreements: [],
                form: new Form({
                    id: "",
                    agreement: "",
                })
            };
        },

        methods: {
            listData() {
                this.$Progress.start();
                axios.get("../api/agreements").then(({
                    data
                }) => (
                    (this.agreements = data),
                    (this.form.reset()),
                    (this.form.fill(data))
                ));
                this.$Progress.finish();
            },

            updateData() {
                this.$Progress.start();
                this.form
                    .put("../api/agreements/" + this.form.id)
                    .then(() => {
                        Fire.$emit("listData");
                        Toast.fire({
                            type: "success",
                            title: "Berhasil Update Data Lembar Persetujuan"
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },
        },

        created() {
            this.listData();
            Fire.$on("listData", () => {
                this.listData();
            });
        },

        mounted() {
        }
    };

</script>
