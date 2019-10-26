<template>
    <div>
        <form>
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Interactive case name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" placeholder="Enter the name..">
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-4 col-form-label">Gender of the patient</label>
                <div class="col-sm-8">
                    <select id="gender" class="form-control form-control-md custom-select">
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="age" class="col-sm-4 col-form-label">Age of the patient</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="age" placeholder="Enter age..">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "PatientForm"
    }
</script>

<style scoped>

</style>
