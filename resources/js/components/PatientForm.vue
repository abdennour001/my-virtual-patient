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
                        <span class="lead tip" style="font-size: 1rem">Tip: <strong>Baby</strong> (0-4), <strong>young</strong> (4-17),
                            <strong>adult</strong> (17-40), <strong>old</strong> (40-100)</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 mt-5">
            <div id="dragdrop" class="row text-center">
                <div class="col-10 offset-1 text-right mb-2">
                    <a v-on:click.prevent="reset"
                            style="color: dodgerblue;">Reset <i class="fas fa-times"></i></a>
                </div>
                <div id="dropzone" class="col-10 offset-1 dropzone-out" style="z-index: -999;" ref="patientZone">
                    <img id="virtualPatient" ref="virtualPatient" :src="virtualCharacter" alt="Please set an age to continue..." class="w-25 m-2"/>
                </div>
                <div class="col-12 mt-4">
                    <div class="container">
                        <div class="row">
                            <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
                                <div class="MultiCarousel-inner">
                                    <div
                                            v-for="injury in injuries"
                                            v-bind:key="injury.id"
                                    >
                                        <div class="item"
                                              :class="injury.enabled ? 'item-enabled' : 'item-disabled'"
                                              :injury-id="injury.id">
                                            <div class="pad15">
                                                <img :src="injury.src" alt="" class="w-75"
                                                >
                                                <p class="m-0"> {{ injury.title }} </p>
                                            </div>
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

    import Vue from 'vue';
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';
    // Init plugin
    Vue.use(Loading);

    let mainState = {
        dragging:-1,
        liveInjuries: [],
    };


    export default {
        name: "PatientForm",
        data() {
            return {
                name: this.$cookies.isKey('patientCookie@name') ? this.$cookies.get('patientCookie@name') : '',
                gender: this.$cookies.isKey('patientCookie@gender') ? this.$cookies.get('patientCookie@gender') : 'male',
                age: this.$cookies.isKey('patientCookie@age') ? this.$cookies.get('patientCookie@age') : '',
                virtualCharacter: this.$cookies.isKey('patientCookie@virtualCharacter') ? this.$cookies.get('patientCookie@virtualCharacter') : 'assets/male/healthy.png',
                mainState,
                injuries: [
                    {
                        id: 0,
                        src:"assets/injuries/broken-arm.png",
                        title:"Broken arm",
                        filename: "broken-arm",
                        gender: "",
                        age: "",
                        enabled: true,
                    },
                    {
                        id: 1,
                        src:"assets/injuries/broken-leg.png",
                        title:"Broken leg",
                        filename: "broken-leg",
                        gender: "",
                        age: "",
                        enabled: true,
                    },
                    {
                        id: 2,
                        src:"assets/injuries/broken-head.png",
                        title:"Broken head",
                        filename: "broken-head",
                        gender: "",
                        age: "",
                        enabled: true,
                    },
                    {
                        id: 3,
                        src:"assets/injuries/fever.png",
                        title:"Fever",
                        filename: "fever",
                        gender: "",
                        age: "",
                        enabled: true,
                    },
                    {
                        id: 4,
                        src:"assets/injuries/pale.png",
                        title:"Pale skin",
                        filename: "pale",
                        gender: "",
                        age: "",
                        enabled: true,
                    },
                    {
                        id: 5,
                        src:"assets/injuries/pregnant.png",
                        title:"Pregnant",
                        filename: "pregnant",
                        gender: "",
                        age: "",
                        enabled: false,
                    },
                    {
                        id: 6,
                        src:"assets/injuries/with-baby.png",
                        title:"Female with a baby",
                        filename: "with-baby",
                        gender: "",
                        age: "",
                        enabled: false,
                    },
                    {
                        id: 7,
                        src:"assets/injuries/runny-nose.png",
                        title:"Runny nose",
                        filename: "runny-nose",
                        gender: "",
                        age: "",
                        enabled: true,
                    },
                    {
                        id: 8,
                        src:"assets/injuries/sleepy.png",
                        title:"Sleepy",
                        filename: "sleepy",
                        gender: "",
                        age: "",
                        enabled: true,
                    },
                    {
                        id: 9,
                        src:"assets/injuries/wheel-chair.png",
                        title:"Wheel chair",
                        filename: "wheel-chair",
                        gender: "",
                        age: "",
                        enabled: true,
                    }]
            }
        },
        mounted() {
            this.updateVirtualPatient();
            this.$cookies.set('patientCookie@gender', this.gender);
            Vue.dragging = this.dragging;
            //this.$cookies.set('patientCookie@virtualCharacter', this.virtualCharacter);

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

                //drag and drop code
                $('.item-enabled').draggable({
                    appendTo: "#dragdrop",
                    containment: "#dragdrop",
                    opacity: 0.7,
                    helper:  function() {
                        let clone = $(this).clone();
                        clone.css("cursor", "grab");
                        clone.css("background", "#f1f1f1");
                        clone.css("color", "#666");
                        clone.css("border-radius", "20px");
                        clone.css("padding", "10px");
                        clone.css("margin", "10px");

                        return clone;
                    },
                    revert: true,
                    start: function(){
                        mainState.dragging = $(this).attr("injury-id");
                    },
                    stop: function(){

                    }
                });
                $("#dropzone").droppable({
                    drop: function(event, ui) {

                        //add injuries to our array
                        if (mainState.dragging !== -1) {
                            mainState.liveInjuries = [];
                            mainState.liveInjuries.push(mainState.dragging);
                            mainState.dragging = -1;
                        }

                        ui.helper.css('opacity', '0');

                        const c = $('#dropzone')[0];

                        let loader = Vue.$loading.show({
                            container: c,
                            opacity: 1,
                            color: 'dodgerblue',
                        });

                        let aig=false;

                        setTimeout(() => {
                            loader.hide();
                            $(this).removeClass('dropzone-over');
                            $(this).addClass('dropzone-out');
                        },500);

                    },
                    over: function(event, ui) {
                        $(this).addClass('dropzone-over');
                        $(this).removeClass('dropzone-out');
                    },
                    out: function(event, ui) {
                        $(this).removeClass('dropzone-over');
                        $(this).addClass('dropzone-out');
                    }
                });

            });

        },
        computed : {
            liveInjuries : function(){
                return this.mainState.liveInjuries;
            },
        },
        methods: {
            updateVirtualPatient() {

                let loader = this.$loading.show({
                    container: this.$refs.patientZone,
                    opacity: 1,
                    color: 'dodgerblue',
                });

                this.mainState.liveInjuries = [];

                if (this.age === '') {
                    this.virtualCharacter = '';
                } else if (this.age <= 4 && this.age >= 0) { // a baby
                    this.virtualCharacter = 'assets/baby/healthy.png';
                } else if (this.age > 4 && this.age <= 17) { // a young
                    if (this.gender === "male") {
                        this.virtualCharacter = 'assets/boy/healthy.png';
                        console.log("young male")
                    } else {
                        this.virtualCharacter = 'assets/girl/healthy.png';
                        console.log("young female")
                    }
                } else if (this.age > 17 && this.age <= 40) { // an adult
                    if (this.gender === "male") {
                        this.virtualCharacter = 'assets/male/healthy.png';
                        console.log("adult male")
                    } else {
                        this.virtualCharacter = 'assets/female/healthy.png';
                        console.log("adult female")
                    }
                } else if (this.age > 40 && this.age <= 100) { // an old
                    if (this.gender === "male") {
                        this.virtualCharacter = 'assets/old-male/healthy.png';
                        console.log("old male")
                    } else {
                        this.virtualCharacter = 'assets/old-female/healthy.png';
                        console.log("old female")
                    }
                }

                setTimeout(() => {
                    loader.hide()
                },500);

                this.$cookies.set('patientCookie@virtualCharacter', this.virtualCharacter);

            },
            reset() {
                this.updateVirtualPatient();
            },
            updateInjury() {
                let injury = this.injuries[this.mainState.liveInjuries[0]];
                if (this.age === '') {
                    this.virtualCharacter = '';
                } else if (this.age <= 4 && this.age >= 0) { // a baby
                    this.virtualCharacter = 'assets/baby/healthy.png';
                } else if (this.age > 4 && this.age <= 17) { // a young
                    if (this.gender === "male") {
                        this.virtualCharacter = 'assets/boy/'+injury.filename+'.png';
                    } else {
                        this.virtualCharacter = 'assets/girl/'+injury.filename+'.png';
                    }
                } else if (this.age > 17 && this.age <= 40) { // an adult
                    if (this.gender === "male") {
                        this.virtualCharacter = 'assets/male/'+injury.filename+'.png';
                    } else {
                        this.virtualCharacter = 'assets/female/'+injury.filename+'.png';
                    }
                } else if (this.age > 40 && this.age <= 100) { // an old
                    if (this.gender === "male") {
                        this.virtualCharacter = 'assets/old-male/'+injury.filename+'.png';
                    } else {
                        this.virtualCharacter = 'assets/old-female/'+injury.filename+'.png';
                    }
                }
                this.$cookies.set('patientCookie@virtualCharacter', this.virtualCharacter);
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
            },
            liveInjuries: function (newValue) {
                if (newValue.length !== 0) {
                    this.updateInjury();
                }
            }
        }
    }
</script>

<style scoped>

    .MultiCarousel {
        float: left;
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
    .MultiCarousel .MultiCarousel-inner .item-disabled {
        opacity: 0.5;
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

    .tip {
        text-align: center;
        padding:10px;
        margin:10px;
        border-radius: 10px;
        background:#f1f1f1;
        color:#666;
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

    #dropzone {
        border-radius: 10px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    }

    .dropzone-out {
        border: 2px solid transparent;
    }

    .dropzone-over {
        border-radius: 10px;
        border: 2px dashed dodgerblue;
    }

    a,
    a label {
        cursor: pointer;
    }

</style>
