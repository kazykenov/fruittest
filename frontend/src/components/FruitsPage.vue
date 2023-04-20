<script setup lang="ts">
import {onMounted, reactive, ref} from "vue";
import FruitItem from "../components/FruitItem.vue";
import axios from "axios";

const props = defineProps<{
  apiRoute?: string,
}>()

const API_URL:string = "{{BACKEND_API_URL}}";
let items:any = ref([]);

onMounted(async () => {
  items.value = await getFruits();
});

const getFruits = async () => {
  const { data } = await axios.get(API_URL + "/fruit/" + props.apiRoute);
  return data;
}

const toggleFavorite = async (item:any) => {
  const url = item.isFavorite ? "remove-from-favorite" : "add-to-favorite";
  await axios.post(API_URL + "/fruit/" + url, {
    fruit_id: item.fruit.id,
  });
  item.isFavorite = !item.isFavorite;
}
</script>

<template>
  <FruitItem v-for="item in items" :is-favorite="item.isFavorite" :is-favorite-click="() => toggleFavorite(item)">
    <template #name>{{ item.fruit.name }}</template>
    <template #family>{{ item.fruit.family }}</template>
    <table>
      <tr v-for="(value,description) in item.fruit.nutritions">
        <td>{{ description }}</td>
        <td>{{ value }}</td>
      </tr>
    </table>
  </FruitItem>
</template>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
