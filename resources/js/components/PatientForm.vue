<template>
    <div class="row">
        <div class="col-12">
            <form>
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Interactive case name</label>
                    <div class="col-sm-8">
                        <input v-model="name" type="text" class="form-control" id="name" placeholder="Enter the name.." required>
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
                <div class="form-group row align-items-center justify-content-center">
                    <label for="age" class="col-sm-4 col-form-label">Age of the patient</label>
                    <div class="col-sm-2">
                        <input v-model="age" type="number" min="1" max="150" class="form-control" id="age" placeholder="Enter age.." required>
                    </div>
                    <div class="col-sm-6 text-left">
                        <span class="lead">Tip: <strong>Baby</strong> (0-4), <strong>young</strong> (4-17),
                            <strong>adult</strong> (17-40), <strong>old</strong> (40-100)</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 mt-5">
            <div id="dragdrop" class="row text-center">
                <div id="dropzone" class="col-12">
                    <img id="virtualPatient" ref="virtualPatient" src="assets/patient.png" alt="Patient image goes here.." class="w-25"/>
                </div>
                <div class="col-12 mt-4">
                    <div class="container">
                        <div class="row">
                            <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
                                <div class="MultiCarousel-inner">
                                    <div class="item">
                                        <div class="pad15">
                                            <img src="assets/broken-arm.svg" alt="" class="w-75">
                                            <p class="m-0">Broken arm</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="pad15">
                                            <img src="assets/broken-arm.svg" alt="" class="w-75">
                                            <p class="m-0">Broken arm</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="pad15">
                                            <img src="assets/broken-arm.svg" alt="" class="w-75">
                                            <p class="m-0">Broken arm</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="pad15">
                                            <img src="assets/broken-arm.svg" alt="" class="w-75">
                                            <p class="m-0">Broken arm</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="pad15">
                                            <img src="assets/broken-arm.svg" alt="" class="w-75">
                                            <p class="m-0">Broken arm</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="pad15">
                                            <img src="assets/broken-arm.svg" alt="" class="w-75">
                                            <p class="m-0">Broken arm</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="pad15">
                                            <img src="assets/broken-arm.svg" alt="" class="w-75">
                                            <p class="m-0">Broken arm</p>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn leftLst"><i class="fas fa-angle-left"></i></button>
                                <button class="btn rightLst"><i class="fas fa-angle-right"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    window.$ = require('jquery');
    require('bootstrap');
    require('jquery-ui-dist/jquery-ui');


    export default {
        name: "PatientForm",
        data() {
            return {
                name: this.$cookies.isKey('patientCookie@name') ? this.$cookies.get('patientCookie@name') : '',
                gender: this.$cookies.isKey('patientCookie@gender') ? this.$cookies.get('patientCookie@gender') : 'male',
                age: this.$cookies.isKey('patientCookie@age') ? this.$cookies.get('patientCookie@age') : '',
                injuries: [
                    {
                        src:"",
                        title:"",
                        gender: "",
                        age: "",
                    },
                    {
                        src:"",
                        title:"",
                        gender: "",
                        age: "",
                    }]
            }
        },
        mounted() {
            this.updateVirtualPatient();
            this.$cookies.set('patientCookie@gender', this.gender);


            $(document).ready(function () {
                var itemsMainDiv = ('.MultiCarousel');
                var itemsDiv = ('.MultiCarousel-inner');
                var itemWidth = "";

                $('.leftLst, .rightLst').click(function () {
                    var condition = $(this).hasClass("leftLst");
                    if (condition)
                        click(0, this);
                    else
                        click(1, this)
                });

                ResCarouselSize();




                $(window).resize(function () {
                    ResCarouselSize();
                });

                //this function define the size of the items
                function ResCarouselSize() {
                    var incno = 0;
                    var dataItems = ("data-items");
                    var itemClass = ('.item');
                    var id = 0;
                    var btnParentSb = '';
                    var itemsSplit = '';
                    var sampwidth = $(itemsMainDiv).width();
                    var bodyWidth = $('body').width();
                    $(itemsDiv).each(function () {
                        id = id + 1;
                        var itemNumbers = $(this).find(itemClass).length;
                        btnParentSb = $(this).parent().attr(dataItems);
                        itemsSplit = btnParentSb.split(',');
                        $(this).parent().attr("id", "MultiCarousel" + id);


                        if (bodyWidth >= 1200) {
                            incno = itemsSplit[3];
                            itemWidth = sampwidth / incno;
                        }
                        else if (bodyWidth >= 992) {
                            incno = itemsSplit[2];
                            itemWidth = sampwidth / incno;
                        }
                        else if (bodyWidth >= 768) {
                            incno = itemsSplit[1];
                            itemWidth = sampwidth / incno;
                        }
                        else {
                            incno = itemsSplit[0];
                            itemWidth = sampwidth / incno;
                        }
                        $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
                        $(this).find(itemClass).each(function () {
                            $(this).outerWidth(itemWidth);
                        });

                        $(".leftLst").addClass("over");
                        $(".rightLst").removeClass("over");

                    });
                }


                //this function used to move the items
                function ResCarousel(e, el, s) {
                    var leftBtn = ('.leftLst');
                    var rightBtn = ('.rightLst');
                    var translateXval = '';
                    var divStyle = $(el + ' ' + itemsDiv).css('transform');
                    var values = divStyle.match(/-?[\d\.]+/g);
                    var xds = Math.abs(values[4]);
                    if (e == 0) {
                        translateXval = parseInt(xds) - parseInt(itemWidth * s);
                        $(el + ' ' + rightBtn).removeClass("over");

                        if (translateXval <= itemWidth / 2) {
                            translateXval = 0;
                            $(el + ' ' + leftBtn).addClass("over");
                        }
                    }
                    else if (e == 1) {
                        var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                        translateXval = parseInt(xds) + parseInt(itemWidth * s);
                        $(el + ' ' + leftBtn).removeClass("over");

                        if (translateXval >= itemsCondition - itemWidth / 2) {
                            translateXval = itemsCondition;
                            $(el + ' ' + rightBtn).addClass("over");
                        }
                    }
                    $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
                }

                //It is used to get some elements from btn
                function click(ell, ee) {
                    var Parent = "#" + $(ee).parent().attr("id");
                    var slide = $(Parent).attr("data-slide");
                    ResCarousel(ell, Parent, slide);
                }

                // drag and drop code
                $('.item').draggable({
                    containment: "#dragdrop",
                });
                $("#dropzone").droppable({
                    drop: function(event, ui) {
                        $(this).css('background', 'rgb(0,200,0)');
                    },
                    over: function(event, ui) {
                        $(this).css('background', 'orange');
                    },
                    out: function(event, ui) {
                        $(this).css('background', 'cyan');
                    }
                });

            });
        },
        methods: {
            updateVirtualPatient() {
                if (this.age < 4) { // a baby

                } else if (this.age > 4 && this.age <= 17) { // a young
                    if (this.gender === "male") {
                        console.log("young male")
                    } else {
                        console.log("young female")
                    }
                } else if (this.age > 17 && this.age <= 40) { // an adult
                    if (this.gender === "male") {
                        console.log("adult male")
                    } else {
                        console.log("adult female")
                    }
                } else if (this.age > 40 && this.age <= 100) { // an old
                    if (this.gender === "male") {
                        console.log("old male")
                    } else {
                        console.log("old female")
                    }
                }
            }
        },
        watch: {
            name: function(newValue) {
                this.$cookies.set('patientCookie@name', newValue);
            },
            gender: function (newValue) {
                this.updateVirtualPatient();
                this.$cookies.set('patientCookie@gender', newValue);
            },
            age: function (newValue) {
                this.updateVirtualPatient();
                this.$cookies.set('patientCookie@age', newValue);
            }
        }
    }
</script>

<style scoped>

    .MultiCarousel {
        float: left;
        overflow: hidden;
        padding: 15px;
        width: 100%;
        position:relative;
    }
    .MultiCarousel .MultiCarousel-inner {
        transition: 1s ease all;
        float: left;
    }
    .MultiCarousel .MultiCarousel-inner .item {
        float: left;
    }

    .MultiCarousel .MultiCarousel-inner .item > div {
        text-align: center;
        padding:10px;
        margin:10px;
        border-radius: 20px;
        background:#f1f1f1;
        color:#666;
        cursor: grab;
    }
    .MultiCarousel .leftLst, .MultiCarousel .rightLst {
        position:absolute;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        top:calc(50% - 20px);
    }
    .btn {
        background: dodgerblue;
        color: white;
    }
    .MultiCarousel .leftLst {
        left:0;
    }
    .MultiCarousel .rightLst {
        right:0;
    }

    .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over {
        pointer-events: none;
        background:#ccc;
    }

</style>
