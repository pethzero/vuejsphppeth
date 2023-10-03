<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

</head>

<body>
    <div id="app" class="container mt-5">
        <h2>Add New Person</h2>
        <form @submit.prevent="addPerson">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" v-model="newPerson.name" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Person</button>
        </form>

        <div>
            {{newPerson}}
        </div>

        <h1>People List</h1>
        <table class="nowrap table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>ระบบจัดเตรียม</th>
                </tr>
            </thead>
            <tbody>
                <!-- ... (โค้ดอื่น ๆ ไม่เปลี่ยน) -->

                <tr v-for="person in people" :key="person.id">
                    <td>{{ person.id }}</td>
                    <td>
                        <span v-if="person.id !== editingPersonId">{{ person.name }}</span>
                        <input v-else type="text" v-model="editedPersonName" class="form-control">
                    </td>
                    <td>
                        <button @click="editPerson(person)" class="btn btn-primary" v-if="person.id !== editingPersonId">Edit</button>
                        <button @click="saveEditedPerson(person.id)" class="btn btn-success" v-if="person.id === editingPersonId">Save</button>
                        <button @click="cancelEdit" class="btn btn-secondary" v-if="person.id === editingPersonId">Cancel</button>
                    </td>
                    <td>
                        <button @click="deletePerson(person.id)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>

                <!-- ... (โค้ดอื่น ๆ ไม่เปลี่ยน) -->
            </tbody>


        </table>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                people: [],
                newPerson: {
                    name: ''
                },
                editingPersonId: null, // Track the ID of the person being edited
                editedPersonName: '' // Track the edited name
            },
            created() {
                console.log('created')
            },
            mounted() {
                this.fetchPeople();
                // let table = new DataTable('#example');
            },
            methods: {
                fetchPeople() {
                    fetch('get_people.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // ทำอะไรกับข้อมูลที่ได้รับเช่นกำหนดค่าให้กับ this.people
                            this.people = data;
                        })
                        .catch(error => {
                            // จัดการข้อผิดพลาดที่เกิดขึ้น
                            console.error('There was a problem with the fetch operation:', error);
                        });

                },
                addPerson() {
                    fetch('add_person.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                name: this.newPerson.name
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            this.people.push(data);
                            this.newPerson.name = '';
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    // $.ajax({
                    //     url: 'add_person.php',
                    //     method: 'POST',
                    //     data: {
                    //         name: this.newPerson.name
                    //     },
                    //     dataType: 'json',
                    //     success: (response) => {
                    //         this.people.push(response);
                    //         this.newPerson.name = '';
                    //     }
                    // });
                },
                deletePerson(id) {
                    console.log(id)
                    $.ajax({
                        url: 'delete_person.php',
                        method: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: (response) => {
                            // Remove the deleted person from the list
                            this.people = this.people.filter(person => person.id !== id);
                        }
                    });
                },
                editPerson(person) {
                    // Start editing a person's name
                    this.editingPersonId = person.id;
                    this.editedPersonName = person.name;
                },
                saveEditedPerson(personId) {
                    // Save the edited name to the server and update the local data
                    $.ajax({
                        url: 'edit_person.php',
                        method: 'POST',
                        data: {
                            id: personId,
                            name: this.editedPersonName
                        },
                        dataType: 'json',
                        success: (response) => {
                            // Update the local data with the edited name
                            const editedPersonIndex = this.people.findIndex(person => person.id === personId);
                            if (editedPersonIndex !== -1) {
                                this.people[editedPersonIndex].name = this.editedPersonName;
                            }
                            // Reset editing mode
                            this.editingPersonId = null;
                            this.editedPersonName = '';
                        }
                    });
                },
                cancelEdit() {
                    // Cancel editing and reset editing mode
                    this.editingPersonId = null;
                    this.editedPersonName = '';
                }
            }
        });
    </script>
</body>

</html>