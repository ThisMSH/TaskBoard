// ===== Add multiple tasks =====
const multiTasks = document.querySelector(".multi-tasks");
const addMultiTasks = document.querySelector("#add-multi-tasks");
let taskCount = 2;

addMultiTasks.addEventListener("click", function () {
    let taskFrom = `
    <div>
        <h2 class="text-xl">Task number: <span>${taskCount}</span></h2>
    </div>
    <div class="input-container relative">
        <select class="w-full p-4 border border-solid border-slate-100 rounded-lg text-slate-100 bg-slate-900 outline-none" name="state[]" id="" required>
            <option value="do">To Do</option>
            <option value="doing">Doing</option>
            <option value="done">Done</option>
        </select>
        <span class="absolute left-0 p-4 pointer-events-none text-slate-100 transition-all duration-500 ease-in-out">The state of the task</span>
    </div>
    <div class="input-container relative">
        <input class="w-full p-4 border border-solid border-slate-100 rounded-lg text-slate-100 bg-slate-900 outline-none" type="text" name="name[]" required>
        <span class="absolute left-0 p-4 pointer-events-none text-slate-100 transition-all duration-500 ease-in-out">The name of the task</span>
    </div>
    <div class="input-container relative">
        <input class="w-full p-4 border border-solid border-slate-100 rounded-lg text-slate-100 bg-slate-900 outline-none" type="text" name="desc[]" required>
        <span class="absolute left-0 p-4 pointer-events-none text-slate-100 transition-all duration-500 ease-in-out">The description of the task</span>
    </div>
    <div class="input-container relative">
        <input class="w-full p-4 border border-solid border-slate-100 rounded-lg text-slate-900 bg-slate-900 outline-none transition-all duration-500 ease-in-out focus:text-slate-100 valid:text-slate-100" type="date" name="date[]" required>
        <span class="absolute left-0 p-4 pointer-events-none text-slate-100 transition-all duration-500 ease-in-out">The deadline of the task</span>
    </div>`;
    let newTask = document.createElement("div");
    newTask.classList.add("relative", "flex", "flex-col", "gap-y-8", "mb-12", "after:absolute", "after:w-1/2", "after:h-0.5", "after:bg-slate-100", "after:-bottom-4", "after:left-1/2", "after:-translate-x-1/2", "after:translate-y-1/2");
    newTask.innerHTML = taskFrom;

    multiTasks.appendChild(newTask);
    taskCount++;
});
