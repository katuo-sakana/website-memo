<template>
    <div class="container">
         <!--メイン-->
        <slick ref="slick" :options="slickOptions" class="slider-for">
        <div style="height:400px; background: blue;"></div>
        <div style="height:400px; background: yellow;"></div>
        <div style="height:400px; background: red;"></div>
        </slick>

        <!--サムネイル-->
        <!-- <slick ref="slick" :options="slickNavOptions" class="slider-nav">
        <div style="height:400px; background: blue;"></div>
        <div style="height:400px; background: yellow;"></div>
        <div style="height:400px; background: red;"></div>
        </slick> -->
    </div>
</template>

<script>
import Slick from 'vue-slick';

export default {
    components: {
        Slick,
    },
    data() {
        return {
            // slickの設定
            slickOptions: {
                autoplay: true,
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
                asNavFor: '.slider-nav',
                slidesToScroll: 3,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 2
                        }
                    },
                ]
            },
            //サムネイル
            slickNavOptions: {
                slidesToShow: 3,
                asNavFor: '.slider-for',
                focusOnSelect: true,
            },
        };
    },
    // methods: {
    //     next() {
    //         this.$refs.slick.next();
    //     },
    //     prev() {
    //         this.$refs.slick.prev();
    //     },
    //     reInit() {
    //         this.$nextTick(() => {
    //             this.$refs.slick.reSlick();
    //         });
    //     },
    // },
}
</script>
