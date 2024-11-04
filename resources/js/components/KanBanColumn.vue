<template>
  <div class="kanban-column flex-1 mx-3"
    :style="{ background: background, color: 'white', maxWidth: '20%', minHeight: '100px', height: 'auto' }">
    <div class="kanban-column-header row">
      <div class="col">

        <h2 class="font-bold">{{ name }}</h2>
      </div>
      <div class="column-option-container col-sm-3 d-flex justify-content-end align-items-center gap-2">
        <button @click="openModal" type="button" class="text-white rounded">
          <font-awesome-icon :icon="['fas', 'pen']" :style="{ color: 'white' }" />
        </button>
        <button @click="deleteColumn(id)" type="button">
          <font-awesome-icon
          :icon="['fas', 'trash']"
          :style="{ color: 'red' }"
          >
          </font-awesome-icon>
        </button>
        
      </div>
      
    </div>
    <div class="px-4 flex-1 overflow-y-auto">
      <Draggable
      :list="tasks"
      group="tasks"
      item-key="id"
      tag="div"
      drag-class="drag"
      ghost-class="ghost"
      @change="onChange"
      >
        <template #item="{ element }">
          <KanBanCard :id="element.id" :name="element.name" :task_type_id="element.task_type_id"
            :task_status_id="element.task_status_id" :description="element.description">
          </KanBanCard>
        </template>
      </Draggable>
    </div>
  </div>
  <div id="editColumnModal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Edit Column</h5>
        <button type="button" class="btn-close" @click="closeModal"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <Form ref="form" @submit="handleSubmit" :validation-schema="schema" v-slot="{ errors }">
          <div class="mb-3">
            <label for="name" class="form-label">Column Name:</label>
            <Field name="name" :class="{ 'is-invalid': errors.name }" type="text" class="form-control" id="name" />
            <ErrorMessage name="name" class="text-danger" />
          </div>
          <div class="mb-3">
            <label for="background_color" :class="{ 'is-invalid': errors.background_color }" class="form-label">Background Color:</label>
            <Field name="background_color" type="color" class="form-control form-control-color" id="background_color" />
            <ErrorMessage name="background_color" class="text-danger" />
          </div>
          <!-- Modal Footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="closeModal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </Form>
        
      </div>

      
    </div>
  </div>
</div>


</template>

<script setup>
import KanBanCard from './KanBanCard.vue';
import { inject, watch, ref, defineEmits } from 'vue';
import Draggable from 'vuedraggable';
import { Form, Field, ErrorMessage  } from 'vee-validate';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import * as yup from 'yup';
import axios from 'axios';

const emit = defineEmits(['columnAdded', 'columnDeleted']);
const form = ref(null);
const schema = yup.object({
  name: yup.string().required(),
  background_color: yup.string(),
});
const formData = ref({
  name: '',
  background_color: '#ffffff',
});


const props = defineProps({
  id: Number,
  name: {
    type: String,
    required: true
  },
  background: {
    type: String,
    required: true
  },
  tasks: Array,
});
const tasks = props.tasks;
watch(() => props.tasks, (newTask) => tasks.value = newTask);

const onChange = (e) => {
  let item = e.added || e.moved;
  if(!item)
    return;

  let taskId = item.element.id;
  
  let index = tasks.findIndex(task => task.id == taskId);
  let prevTask = index > 0 ? tasks[index - 1] : null;
  let nextTask = index < tasks.length - 1 ? tasks[index + 1] : null;
  let task = tasks[index];
  let position = task.pivot.index;

  if(prevTask && nextTask){
    position = (prevTask.pivot.index + nextTask.pivot.index) / 2;
  } else if (prevTask){
    position = prevTask.pivot.index + (prevTask.pivot.index / 2);
  } else if (nextTask){
    position = nextTask.pivot.index / 2;
  }

  axios.put('/api/updateTaskIndex', {
      params:{
        index: position,
        taskId: task.id,
        columnId: props.id,
      }
    })
    .then((response) => {

    });
};

const handleSubmit = (values) => {
  
  axios.post('/api/column', values)
    .then((response) => {
      emit('columnAdded', response.data);
      form.value.resetForm();
    });
  $('#editColumnModal').modal('hide');
};

const deleteColumn = () => {
  axios.delete('/api/column/' + props.id)
    .then((response) => {
      emit('columnDeleted', props.id);
      form.value.resetForm();
    });
};

const openModal = () => {
  $('#editColumnModal').modal('show');
};

</script>