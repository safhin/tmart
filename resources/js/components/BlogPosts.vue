<template>
  <section class="htc__blog__area bg__white pb--130">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__title section__title--2 text-center">
                        <h2 class="title__line">Latest News</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod temp incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog__wrap clearfix mt--60 xmt-30">
                    <!-- Start Single Blog -->
                    <div v-for="post in posts" class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                        <div class="blog foo">
                            <div class="blog__inner">
                                <div class="blog__thumb">
                                    <a href="blog-details.html">
                                        <blog-image :url="post._links['wp:featuredmedia'][0].href"></blog-image>
                                    </a>
                                    <div class="blog__post__time">
                                        <div class="post__time--inner">
                                            <span class="date">14</span>
                                            <span class="month">Sep</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog__hover__info">
                                    <div class="blog__hover__action">
                                        <p class="blog__des"><a :href="post.link">{{ post.title.rendered }}</a></p>
                                        <ul class="bl__meta">
                                            <li>By :<a href="#">Admin</a></li>
                                            <li>Product</li>
                                        </ul>
                                        <div class="blog__btn">
                                            <a class="read__more__btn" :href="post.link">read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Blog -->
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import BlogImage from './BlogImage'
export default {
    components:{
        BlogImage
    },
    created(){
        axios.get('https://blog.laravelecommerceexample.ca/wp-json/wp/v2/posts?per_page=3')
        .then(response => {
            this.posts = response.data
        })
    },
    data(){
        return{
            posts: []
        }
    }
}
</script>
