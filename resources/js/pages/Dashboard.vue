<script setup lang="ts">
import { ref, onMounted } from "vue";
import axios from "axios";
import AppLayout from "@/layouts/AppLayout.vue";

const shelves = ref<{ year: number; books: string[] }[]>([]);

const fetchBooks = async () => {
  try {
    const response = await axios.get("http://127.0.0.1:8000/bookshelves");

    shelves.value = Object.entries(response.data).map(([year, books]) => ({
      year: Number(year),
      books: books.map((book: any) => book.book_title),
    }));
  } catch (error) {
    console.error("Error fetching bookshelves:", error);
  }
};

onMounted(fetchBooks);

</script>

<template>
  <AppLayout>
    <div class="p-6 bg-gradient-to-r from-gray-900 to-gray-700 min-h-screen flex flex-col items-center justify-center">
      <h1 class="text-3xl font-bold mb-6 text-white">Library Bookshelves</h1>
      <div class="w-full max-w-4xl p-6 rounded-lg shadow-2xl relative flex flex-col space-y-6 border-b-4 border-gray-800 shelf-container">
        <div v-for="(shelf, index) in shelves" :key="index" class="relative p-4 border-b-4 last:border-b-0 shelf-section flex items-center">
          <span class="absolute left-3 top-1 text-white font-bold text-lg">{{ shelf.year }}</span>
          <div class="flex space-x-4 w-full justify-center">
            <div v-for="(book, i) in shelf.books" :key="i" class="relative w-20 h-28 bg-gradient-to-r from-yellow-600 to-yellow-800 rounded-lg shadow-xl flex items-center justify-center border-l-4 border-gray-500 book transform hover:scale-110 transition-all duration-300 ease-in-out">
              <div class="absolute bottom-full mb-2 hidden bg-gray-900 text-white text-xs p-2 rounded shadow-lg book-title">
                {{ book }}
              </div>
            </div>
          </div>
          <div class="absolute bottom-0 left-0 w-full h-2 bg-brown-800 shadow-lg"></div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.shelf-container {
  background-color: #4B2E22;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.5);
}

.shelf-section {
  background: linear-gradient(to bottom, #7B4F3E, #5A3825);
  box-shadow: inset 0px -2px 6px rgba(0, 0, 0, 0.7);
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 15px;
  border-radius: 8px;
}

.book {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 10px;
  box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.6);
  cursor: pointer;
  transition: transform 0.3s ease-in-out;
  padding: 6px;
}

.book:hover {
  transform: scale(1.1);
}

.book-title {
  display: none;
  position: absolute;
  width: max-content;
  text-align: center;
  font-weight: bold;
}

.book:hover .book-title {
  display: block;
}
</style>