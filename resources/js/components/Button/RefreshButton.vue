<template>
    <div>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-sync mr-2"></i>
            Refresh
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>All information will be lost after refreshing, are you sure that you want to procedure?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="refresh">Refresh</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "RefreshButton",
        methods: {
            refresh() {
                // declaring the regex
                let regex = new RegExp("(patientCookie@).*");
                // remove all our cookies from the browser
                for(let key of this.$cookies.keys()) {
                    if (regex.test(key)) {
                        this.$cookies.remove(key);
                    }
                }
                document.location.reload();
                window.scroll(0, 0);
            }
        }
    }
</script>

<style scoped>

</style>
