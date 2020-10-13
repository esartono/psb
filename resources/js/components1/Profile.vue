<template>
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-5 mb-3">
            <div class="card h-100">
                <div class="card-header white bg-SMP card-TK-outline text-center">
                    <h3>USER PROFILE</h3>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img src="/img/user.svg" class="profile-user-img img-fluid img-circle" alt="Logo NF">
                    </div>
                    <h3 class="profile-username text-center text-uppercase mt-3 mb-3">{{ user.name }}</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ user.email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>No. Ponsel</b> <a class="float-right">{{ user.phone }}</a>
                        </li>
                        <li class="list-group-item text-center">
                            <a class="btn btn-info btn-lg white" @click="resetPass()">Ganti Password</a>
                        </li>
                    </ul>
                </div>
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
                levels: {},
                user: {},
                messageText: '',
            };
        },

        methods: {
            resetPass() {
                Swal.fire({
                    title: 'Password Baru',
                    input: 'password',
                    inputPlaceholder: 'Password Baru',
                    showCancelButton: true,
                })
                    .then((result) => {
                        axios
                            .post("../api/gpass/"+result.value)
                            .then(() => {
                                Toast.fire({
                                    type: "success",
                                    title: "Berhasil Ganti Password"
                                });
                            })
                    })
                    .catch(() => {});
            },
        },

        mounted() {
            axios
                .get("../api/users/1")
                .then(({ data }) => (this.user = data))
        }
    }
</script>
