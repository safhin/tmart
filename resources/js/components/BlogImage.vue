<template>
  <img :src="imageSrc" alt="blog images">
</template>

<script>
export default {
    props:['url'],
    created(){
        axios.get(this.url)
        .then(response => {
            this.imageSrc = response.data.media_details.sizes.large.source_url
        })
    },
    data(){
        return{
            imageSrc: ''
        }
    }
}
</script>
