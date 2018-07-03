<template>
    <p>This is the catalog</p>
</template>

<script>
    import CatalogApi from '../services/Catalog'
    export default {
        created() {
            CatalogApi.get('/api/manager/catalog/list').then(data => {
                console.log(data);
            });
        },
        name: "Catalog"
    }
</script>