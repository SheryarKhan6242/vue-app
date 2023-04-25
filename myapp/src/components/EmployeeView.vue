<template>
    <div class="hello">
        <h2>Employee Registration</h2>
        <form @submit.prevent="save">
        <div class="form-group">
            <label>Employee Name</label>
            <input type="text" v-model="employee.name" class="form-control" placeholder="Employee Name">
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="text" v-model="employee.address" class="form-control" placeholder="Employee Address">
        </div>
        <div class="form-group">
            <label>Mobile</label>
            <input type="text" v-model="employee.mobile" class="form-control" placeholder="Mobile">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      <h2>Employee View</h2>
      <table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Employee Name</th>
            <th scope="col">Address</th>
            <th scope="col">Mobile</th>
            <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="employee in result" v-bind:key="employee.id">
            <th scope="row">{{ employee.id }}</th>
            <td>{{ employee.name }}</td>
            <td>{{ employee.address }}</td>
            <td>{{ employee.mobile }}</td>
            <td>
                <button type="button" class="btn btn-warning" @click="edit(employee)">Edit</button>
                <button type="button" class="btn btn-danger" @click="remove(employee)">Delete</button>
            </td>
            </tr>
        </tbody>
        </table>  
    </div>
  </template>
  
  <script>
import Vue from 'vue';
import axios from 'axios';

Vue.use(axios)

  export default {
    name: 'EmployeeView',
    data () {
      return {
        // msg: 'Welcome to Your Vue.js App'
        result : {},
        employee : {
            id: '',
            name: '',
            address: '',
            mobile: ''
        }
      }
    },
    created() {
        this.EmployeeLoad();
    },
    methods: {
        EmployeeLoad()
        {
            var page = "http://localhost/vue-crud/vue-app/public/api/employees";
            axios.get(page)
            .then(
                ({data})=>{
                    console.log(data)
                    this.result = data;
                }
            );
        },
        save()
        {
            if(this.employee.id == '')
            {
                this.saveData();
            }
            else
            {
                this.updateData();
            }
        },
        saveData()
        {
            axios.post("http://localhost/vue-crud/vue-app/public/api/save",this.employee)
            .then(
                ({data})=>{
                    alert("saved");
                }
            );
        },
        edit(employee)
        {
            this.employee = employee;
        },
        updateData()
        {
            var editRecords = "http://localhost/vue-crud/vue-app/public/api/update/"+this.employee.id;
            axios.put(editRecords,this.employee)
            .then(
                ({data})=>{
                    this.employee.name = '';
                    this.employee.address = '',
                    this.employee.mobile = ''
                    this.employee.id = ''
                    alert("updated");
                    this.EmployeeLoad(); 
                }
            )
        },
        remove(employee)
        {
            var deleteRecords = "http://localhost/vue-crud/vue-app/public/api/delete/"+employee.id;
            axios.delete(deleteRecords)
            alert("Deleted");
            this.EmployeeLoad();
        }
    }
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
  h1, h2 {
    font-weight: normal;
  }
  ul {
    list-style-type: none;
    padding: 0;
  }
  li {
    display: inline-block;
    margin: 0 10px;
  }
  a {
    color: #42b983;
  }
  </style>
  