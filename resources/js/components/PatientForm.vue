<template>
    <div>
        <form>
            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Interactive case name</label>
                <div class="col-sm-8">
                    <input v-model="name" type="text" class="form-control" id="name" placeholder="Enter the name..">
                </div>
            </div>
            <div class="form-group row">
                <label for="gender" class="col-sm-4 col-form-label">Gender of the patient</label>
                <div class="col-sm-8">
                    <select v-model="gender" id="gender" class="form-control form-control-md custom-select">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="age" class="col-sm-4 col-form-label">Age of the patient</label>
                <div class="col-sm-8">
                    <input v-model="age" type="number" class="form-control" id="age" placeholder="Enter age.." max="150">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "PatientForm",
        data() {
            return {
                name: this.$cookies.isKey('patientCookie@name') ? this.$cookies.get('patientCookie@name') : '',
                gender: this.$cookies.isKey('patientCookie@gender') ? this.$cookies.get('patientCookie@gender') : 'male',
                age: this.$cookies.isKey('patientCookie@age') ? this.$cookies.get('patientCookie@age') : '',
            }
        },
        watch: {
            name: function(newValue) {
                this.$cookies.set('patientCookie@name', newValue);
            },
            gender: function (newValue) {
                this.$cookies.set('patientCookie@gender', newValue);
            },
            age: function (newValue) {
                this.$cookies.set('patientCookie@age', newValue);
            }
        }
    }
</script>

<style scoped>

</style>
