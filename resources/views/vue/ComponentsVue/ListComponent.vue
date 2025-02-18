<template>

    <router-link :to="{name:'save'}">Ir a la lista de posts</router-link>
    <div>
        <h1>Post List</h1>
    </div>
    <o-button @click="clickMe">APRETA EL BOTON</o-button>

    <o-field label="Email" variant="danger">
        <o-input type="Email" value="alberto"></o-input>
    </o-field>

    <o-table :data="posts.data" :loading="isLoading">

        <o-table-column field="id" label="ID" v-slot="p">
            {{ p.row.id }}
        </o-table-column>

        <o-table-column field="title" label="Title" v-slot="p">
            {{ p.row.title }}
        </o-table-column>

        <o-table-column field="content" label="Content" v-slot="p">
            {{ p.row.content }}
        </o-table-column>

        <o-table-column field="description" label="Description" v-slot="p">
            {{ p.row.description }}
        </o-table-column>

        <o-table-column field="image" label="Image" v-slot="p">
            {{ p.row.image }}
        </o-table-column>

        <o-table-column field="status" label="Status" v-slot="p">
            {{ p.row.status }}
        </o-table-column>
    </o-table>

    <o-pagination 
    v-if="posts.data && posts.data.length > 0"
    @change="updatePage"
    :total="posts.total"
    v-model:current="currentPage"
    :range-before="5"
    :range-after="5"
    size="small"
    :simple="false"
    :rounded="true"
    :per-page="posts.per_page"
    >
    </o-pagination>


</template>

<script>
export default {
    name: "ListComponent",
    mounted() {
        this.listPage()
    },

    methods: {
        clickMe(){
            alert('AHHHHHHHHHHHHHHH')
        },
        updatePage(){
            setTimeout(() => {
                this.listPage()
            }, 100);
        },
        listPage(){
            this.isLoading = true
            this.$axios.get('/api/post?page='+this.currentPage).then((res) => {
                this.posts = res.data[0];
                this.isLoading = false;
                console.log(res.data[0].data);  
            }).catch((error) => {
                console.error("Error al obtener los datos:", error);
            });
        }
    },

    data() {
        return {
            posts: { data: [], total: 0, per_page: 10 }, 
            isLoading: true,
            currentPage: 1,
        }
    },
};
</script>