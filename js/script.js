// Select elements
const todoForm = document.getElementById('todo-form');
const newTaskInput = document.getElementById('new-task');
const todoList = document.getElementById('todo-list');

// Add event listener for the form submission
todoForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from refreshing the page

  // Get the value of the input
  const taskText = newTaskInput.value.trim();

  // Ensure the task is not empty
  if (taskText !== '') {
    addTaskToList(taskText); // Add task to the list
    newTaskInput.value = ''; // Clear the input field
  }
});

// Function to create and add a task to the list
function addTaskToList(taskText) {
  // Create a new list item
  const listItem = document.createElement('li');

  // Add task text
  const taskSpan = document.createElement('span');
  taskSpan.textContent = taskText;
  listItem.appendChild(taskSpan);

  // Add edit button
  const editButton = document.createElement('button');
  editButton.textContent = 'Edit';
  editButton.className = 'edit-btn';
  listItem.appendChild(editButton);

  // Add delete button
  const deleteButton = document.createElement('button');
  deleteButton.textContent = 'Delete';
  deleteButton.className = 'delete-btn';
  listItem.appendChild(deleteButton);

  // Add event listener to the edit button
  editButton.addEventListener('click', function() {
    if (editButton.textContent === 'Edit') {
      // Change to editable mode
      const editInput = document.createElement('input');
      editInput.type = 'text';
      editInput.value = taskSpan.textContent;
      listItem.insertBefore(editInput, taskSpan);
      listItem.removeChild(taskSpan);
      editButton.textContent = 'Save';
    } else {
      // Save the edited value
      const editInput = listItem.querySelector('input');
      taskSpan.textContent = editInput.value;
      listItem.insertBefore(taskSpan, editInput);
      listItem.removeChild(editInput);
      editButton.textContent = 'Edit';
    }
  });

  // Add event listener to the delete button
  deleteButton.addEventListener('click', function() {
    todoList.removeChild(listItem); // Remove the task from the list
  });

  // Add the list item to the todo list
  todoList.appendChild(listItem);
}
