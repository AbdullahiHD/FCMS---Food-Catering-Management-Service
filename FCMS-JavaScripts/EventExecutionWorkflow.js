const draggables = document.querySelectorAll(".task");
const droppables = document.querySelectorAll(".swim-lane");

// Add event listeners to each task element for drag and drop functionality
draggables.forEach((task) => {
  // When a task is starting to be dragged
  task.addEventListener("dragstart", () => {
    task.classList.add("is-dragging");
  });
  // When the dragging of a task is completed
  task.addEventListener("dragend", () => {
    task.classList.remove("is-dragging");
  });
});

droppables.forEach((zone) => {
  zone.addEventListener("dragover", (e) => {
    // Prevent browser page refresh to enable drag and drop functionality
    e.preventDefault();

    const bottomTask = insertAboveTask(zone, e.clientY);
    const curTask = document.querySelector(".is-dragging");

    if (!bottomTask) {
      // Append the currently dragging task to the swim lane
      zone.appendChild(curTask);
    } else {
      // Insert the currently dragging task above the bottomTask
      zone.insertBefore(curTask, bottomTask);
    }
  });
});

// Function to find the task above the current mouse position within a swim lane
const insertAboveTask = (zone, mouseY) => {
  const els = zone.querySelectorAll(".task:not(.is-dragging)");

  let closestTask = null;
  let closestOffset = Number.NEGATIVE_INFINITY;

  els.forEach((task) => {
    const { top } = task.getBoundingClientRect();

    const offset = mouseY - top;

    if (offset < 0 && offset > closestOffset) {
      closestOffset = offset;
      closestTask = task;
    }
  });

  return closestTask;
};

const form = document.getElementById("todo-form");
const input = document.getElementById("todo-input");
const todoLane = document.getElementById("todo-lane");

form.addEventListener("submit", (e) => {
  // Prevent the page from refreshing
  e.preventDefault();

  // Check if the input value is empty and do not add a task if it's empty
  const value = input.value;

  if (!value) return;

  const newTask = document.createElement("p");
  newTask.classList.add("task");
  newTask.setAttribute("draggable", "true");
  newTask.innerText = value;

  newTask.addEventListener("dragstart", () => {
    newTask.classList.add("is-dragging");
  });

  newTask.addEventListener("dragend", () => {
    newTask.classList.remove("is-dragging");
  });

  todoLane.appendChild(newTask);

  input.value = "";
});
