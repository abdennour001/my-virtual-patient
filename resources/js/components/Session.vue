<template>
    <div class="container w-75 p-5">
        <div class="row text-center">
            <div class="col-12">
                <h2 style="color: dodgerblue">{{ sessionName }}</h2>
            </div>
        </div>
        <div class="p-5">
            <div class="d-flex flex-row justify-content-center" style="font-size: 1.2rem">
                <span class="mr-auto align-self-center"><i class="fas fa-clock mr-2"></i>20:00</span>
                <a class="btn btn-danger" href="#"><i class="fas fa-times mr-2"></i>End</a>
            </div>
            <div class="d-flex justify-content-center my-4">
                <img src="/assets/patient.png" alt="Patient image goes here.." class="w-25"/>
            </div>
            <div class="row text-center">
                <div class="col-12 jumbotron py-2" style="padding: 0;width: 100%">
                    <p class="m-0" style="font-size: 1rem">you can ask me a question about my condition bellow, and every thing i say will be written here...</p>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-column justify-content-center">
                <div class="form-group p-2">
                    <label for="exampleFormControlTextarea1">Answer</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write the answer.."></textarea>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between">
                <a style="width: 15%;" type="submit" class="btn btn-dark" href="#"><i class="fa fa-angle-left mr-2 font-weight-bolder"></i>Previous</a>
                <a style="width: 15%;" class="btn btn-dark" href="#">Next<i class="fa fa-angle-right ml-2 font-weight-bolder"></i></a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Session",
        props: ["sessionId", "sessionName", "interactiveCaseId"],
        data() {
            return {
                time: 0,
            }
        },
        beforeMount() { // make the api call before mounting the component.

            // show a spinner while fetching data from the server

            // make the api call.

        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
