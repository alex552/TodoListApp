<template>
    <main class="app">
        <section class="greeting">
            <h3 class="title">To-Do List Application Demo</h3>
        </section>

        <div class="input-section">
            <section class="create-todo">
                <form @submit.prevent="addTodo">
                    <h3>What do you plan on doing🙂?</h3>
                    <input
                        type="text"
                        placeholder="e.g. write a blog post about Vue.js"
                        v-model="text"
                    />
                    <input type="submit" value="Add todo"/>
                </form>
            </section>
        </div>

        <div class="todo-section">
            <section class="todo-list">
                <h2 v-show="todos.length === 0">No Todos Here😞</h2>

                <div class="list">
                    <div
                        v-for="todo in todos"
                        :class="`todo-item ${todo.completed && 'done'}`"
                    >
                        <label>
                            <input type="checkbox" :checked="todo.completed" @click="toggleCompleted(todo)"/>
                        </label>

                        <div class="todo-content">
                            <input type="text" v-model="todo.title" disabled/>
                        </div>

                        <div class="actions">
                            <button class="delete" @click="deleteTodo(todo)">Delete</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</template>

<script setup>
import {ref, onMounted} from "vue";

const todos = ref([]);
const text = ref("");

function addTodo() {
    if (text.value.trim() === "") {
        return;
    }

    axios({
        method: "post",
        url: "/api/v1/todos",
        data: {
            title: text.value,
            completed: false,
        },
    }).then((response) => {
        todos.value.push(response.data);
    }).catch((error) => {
        console.log(error);
    });
    text.value = "";
}

function deleteTodo(todo) {
    axios({
        method: "delete",
        url: `/api/v1/todos/${todo.id}`,
    }).then(() => {
        todos.value = todos.value.filter((t) => t.id !== todo.id);
    }).catch((error) => {
        console.log(error);
    });
}

function toggleCompleted(todo) {
    axios({
        method: "put",
        url: `/api/v1/todos/${todo.id}`,
        data: {
            title: todo.title,
            completed: !todo.completed,
        },
    }).then((response) => {
        todo.completed = response.data.completed;
    }).catch((error) => {
        console.log(error);
    });

}

onMounted(() => {
    axios({
        method: "get",
        url: "/api/v1/todos",
    }).then((response) => {
        todos.value = response.data;
    });
});
</script>
