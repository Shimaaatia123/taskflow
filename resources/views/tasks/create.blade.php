<x-app-layout>

    <div class="taskflow-task-form">

        <div class="taskflow-task-form-header">

            <div>
                <div class="taskflow-task-form-eyebrow">
                    <i class="bi bi-check2-square"></i>
                    {{ app()->getLocale() === 'ar' ? 'إدارة المهام' : 'TASK MANAGEMENT' }}
                </div>

                <h1>
                    {{ app()->getLocale() === 'ar' ? 'إنشاء مهمة جديدة' : 'Create New Task' }}
                </h1>

                <p>
                    {{ app()->getLocale() === 'ar'
                        ? 'أضيفي مهمة جديدة وحددي تفاصيلها ومسؤولها وموعدها.'
                        : 'Create a task and define its details, assignee, priority, and due date.' }}
                </p>
            </div>

            <a href="{{ route('tasks.index') }}" class="taskflow-task-form-back">
                <i class="bi bi-arrow-left"></i>

                <span>
                    {{ app()->getLocale() === 'ar' ? 'العودة للمهام' : 'Back to Tasks' }}
                </span>
            </a>

        </div>


        <div class="taskflow-task-form-card">

            <div class="taskflow-task-form-card-header">

                <div class="taskflow-task-form-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <div>
                    <h2>
                        {{ app()->getLocale() === 'ar' ? 'بيانات المهمة' : 'Task Information' }}
                    </h2>

                    <p>
                        {{ app()->getLocale() === 'ar'
                            ? 'أدخلي البيانات الأساسية للمهمة.'
                            : 'Enter the basic information for this task.' }}
                    </p>
                </div>

            </div>


            <form method="POST" action="{{ route('tasks.store') }}" class="taskflow-task-form-body">

                @csrf


                <div class="taskflow-task-form-group">

                    <label for="project_id">
                        <i class="bi bi-kanban"></i>

                        {{ app()->getLocale() === 'ar' ? 'المشروع' : 'Project' }}
                    </label>

                    <select id="project_id" name="project_id" required>
                        <option value="">
                            {{ app()->getLocale() === 'ar' ? 'اختاري المشروع' : 'Select a project' }}
                        </option>

                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" @selected(old('project_id', $selectedProject) == $project->id)>
                                {{ $project->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('project_id')
                        <div class="taskflow-task-form-error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="taskflow-task-form-group">

                    <label for="title_ar">
                        <i class="bi bi-type"></i>

                        {{ app()->getLocale() === 'ar' ? 'عنوان المهمة بالعربية' : 'Arabic Task Title' }}
                    </label>

                    <input type="text" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" dir="rtl"
                        required>

                    @error('title_ar')
                        <div class="taskflow-task-form-error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="taskflow-task-form-group">

                    <label for="title_en">
                        <i class="bi bi-type"></i>

                        {{ app()->getLocale() === 'ar' ? 'عنوان المهمة بالإنجليزية' : 'English Task Title' }}
                    </label>

                    <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}" dir="ltr"
                        required>

                    @error('title_en')
                        <div class="taskflow-task-form-error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="taskflow-task-form-grid">

                    <div class="taskflow-task-form-group">

                        <label for="description_ar">
                            <i class="bi bi-translate"></i>

                            {{ app()->getLocale() === 'ar' ? 'الوصف بالعربية' : 'Arabic Description' }}
                        </label>

                        <textarea id="description_ar" name="description_ar" rows="5" dir="rtl">{{ old('description_ar') }}</textarea>

                        @error('description_ar')
                            <div class="taskflow-task-form-error">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="taskflow-task-form-group">

                        <label for="description_en">
                            <i class="bi bi-translate"></i>

                            {{ app()->getLocale() === 'ar' ? 'الوصف بالإنجليزية' : 'English Description' }}
                        </label>

                        <textarea id="description_en" name="description_en" rows="5" dir="ltr">{{ old('description_en') }}</textarea>

                        @error('description_en')
                            <div class="taskflow-task-form-error">{{ $message }}</div>
                        @enderror

                    </div>

                </div>


                <div class="taskflow-task-form-grid taskflow-task-form-grid-three">

                    <div class="taskflow-task-form-group">

                        <label for="assigned_to">
                            <i class="bi bi-person"></i>

                            {{ app()->getLocale() === 'ar' ? 'تعيين إلى' : 'Assign To' }}
                        </label>

                        <select id="assigned_to" name="assigned_to">

                            <option value="">
                                {{ app()->getLocale() === 'ar' ? 'غير معيّنة' : 'Unassigned' }}
                            </option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('assigned_to') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('assigned_to')
                            <div class="taskflow-task-form-error">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="taskflow-task-form-group">

                        <label for="priority">
                            <i class="bi bi-flag"></i>

                            {{ app()->getLocale() === 'ar' ? 'الأولوية' : 'Priority' }}
                        </label>

                        <select id="priority" name="priority" required>

                            <option value="low" {{ old('priority', 'medium') === 'low' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'منخفضة' : 'Low' }}
                            </option>

                            <option value="medium" {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'متوسطة' : 'Medium' }}
                            </option>

                            <option value="high" {{ old('priority', 'medium') === 'high' ? 'selected' : '' }}>
                                {{ app()->getLocale() === 'ar' ? 'عالية' : 'High' }}
                            </option>

                        </select>

                        @error('priority')
                            <div class="taskflow-task-form-error">{{ $message }}</div>
                        @enderror

                    </div>


                    <div class="taskflow-task-form-group">

                        <label for="due_date">
                            <i class="bi bi-calendar3"></i>

                            {{ app()->getLocale() === 'ar' ? 'موعد الاستحقاق' : 'Due Date' }}
                        </label>

                        <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}">

                        @error('due_date')
                            <div class="taskflow-task-form-error">{{ $message }}</div>
                        @enderror

                    </div>

                </div>


                <div class="taskflow-task-form-footer">

                    <a href="{{ route('tasks.index') }}" class="taskflow-task-form-cancel">
                        {{ app()->getLocale() === 'ar' ? 'إلغاء' : 'Cancel' }}
                    </a>

                    <button type="submit" class="taskflow-task-form-submit">
                        <i class="bi bi-check2-circle"></i>

                        <span>
                            {{ app()->getLocale() === 'ar' ? 'إنشاء المهمة' : 'Create Task' }}
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>

<script>
    const projectSelect = document.getElementById('project_id');
    const assignedToSelect = document.getElementById('assigned_to');
    const oldAssignedTo = @json(old('assigned_to'));

    projectSelect.addEventListener('change', function() {

        if (!this.value) {
            assignedToSelect.innerHTML = '<option value="">Unassigned</option>';
            return;
        }

        fetch(`/en/projects/${this.value}/members`)
            .then(response => response.json())
            .then(users => {
                assignedToSelect.innerHTML = '<option value="">Unassigned</option>';

                users.forEach(user => {
                    assignedToSelect.innerHTML += `
                        <option value="${user.id}" ${oldAssignedTo == user.id ? 'selected' : ''}>
                            ${user.name}
                        </option>
                    `;
                });
            });
    });

    if (projectSelect.value) {
        projectSelect.dispatchEvent(new Event('change'));
    }
</script>
