<x-app-layout>

    <div class="taskflow-task-form">

        {{-- Header --}}
        <div class="taskflow-task-form-header">

            <div>
                <div class="taskflow-task-form-eyebrow">
                    <i class="bi bi-pencil-square"></i>

                    {{ app()->getLocale() === 'ar'
                        ? 'تعديل المهمة'
                        : 'EDIT TASK' }}
                </div>

                <h1>
                    {{ app()->getLocale() === 'ar'
                        ? 'تعديل المهمة'
                        : 'Edit Task' }}
                </h1>

                <p>
                    {{ app()->getLocale() === 'ar'
                        ? 'حدّث تفاصيل المهمة وحالتها وأولويتها بسهولة.'
                        : 'Update the task details, status, priority and assignment.' }}
                </p>
            </div>

            <a
                href="{{ route('tasks.show', $task) }}"
                class="taskflow-task-form-back"
            >
                <i class="bi bi-arrow-left"></i>

                <span>
                    {{ app()->getLocale() === 'ar'
                        ? 'العودة إلى المهمة'
                        : 'Back to Task' }}
                </span>
            </a>

        </div>


        {{-- Form Card --}}
        <div class="taskflow-task-form-card">

            <div class="taskflow-task-form-card-header">

                <div class="taskflow-task-form-icon">
                    <i class="bi bi-sliders"></i>
                </div>

                <div>
                    <h2>
                        {{ app()->getLocale() === 'ar'
                            ? 'بيانات المهمة'
                            : 'Task Information' }}
                    </h2>

                    <p>
                        {{ app()->getLocale() === 'ar'
                            ? 'عدّلي البيانات المطلوبة ثم احفظي التغييرات.'
                            : 'Update the required information and save your changes.' }}
                    </p>
                </div>

            </div>


            <form
                method="POST"
                action="{{ route('tasks.update', $task) }}"
            >

                @csrf
                @method('PUT')


                <div class="taskflow-task-form-body">

                    {{-- Project --}}
                    <div class="taskflow-task-form-group">

                        <label for="project_id">
                            <i class="bi bi-kanban"></i>

                            {{ app()->getLocale() === 'ar'
                                ? 'المشروع'
                                : 'Project' }}
                        </label>

                        <select
                            id="project_id"
                            name="project_id"
                        >
                            @foreach($projects as $project)
                                <option
                                    value="{{ $project->id }}"
                                    @selected(old('project_id', $task->project_id) == $project->id)
                                >
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('project_id')
                            <div class="taskflow-task-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Titles --}}
                    <div class="taskflow-task-form-grid">

                        <div class="taskflow-task-form-group">

                            <label for="title_ar">
                                <i class="bi bi-type"></i>
                                عنوان المهمة بالعربية
                            </label>

                            <input
                                type="text"
                                id="title_ar"
                                name="title_ar"
                                value="{{ old('title_ar', $task->title_ar) }}"
                                dir="rtl"
                            >

                            @error('title_ar')
                                <div class="taskflow-task-form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="taskflow-task-form-group">

                            <label for="title_en">
                                <i class="bi bi-type"></i>
                                Task Title
                            </label>

                            <input
                                type="text"
                                id="title_en"
                                name="title_en"
                                value="{{ old('title_en', $task->title_en) }}"
                                dir="ltr"
                            >

                            @error('title_en')
                                <div class="taskflow-task-form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- Descriptions --}}
                    <div class="taskflow-task-form-grid">

                        <div class="taskflow-task-form-group">

                            <label for="description_ar">
                                <i class="bi bi-file-text"></i>
                                وصف المهمة بالعربية
                            </label>

                            <textarea
                                id="description_ar"
                                name="description_ar"
                                dir="rtl"
                            >{{ old('description_ar', $task->description_ar) }}</textarea>

                            @error('description_ar')
                                <div class="taskflow-task-form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="taskflow-task-form-group">

                            <label for="description_en">
                                <i class="bi bi-file-text"></i>
                                Task Description
                            </label>

                            <textarea
                                id="description_en"
                                name="description_en"
                                dir="ltr"
                            >{{ old('description_en', $task->description_en) }}</textarea>

                            @error('description_en')
                                <div class="taskflow-task-form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- Assignment / Priority / Status --}}
                    <div class="taskflow-task-form-grid taskflow-task-form-grid-three">

                        {{-- Assignee --}}
                        <div class="taskflow-task-form-group">

                            <label for="assigned_to">
                                <i class="bi bi-person"></i>

                                {{ app()->getLocale() === 'ar'
                                    ? 'تعيين إلى'
                                    : 'Assign To' }}
                            </label>

                            <select
                                id="assigned_to"
                                name="assigned_to"
                            >

                                <option value="">
                                    {{ app()->getLocale() === 'ar'
                                        ? 'غير معيّن'
                                        : 'Unassigned' }}
                                </option>

                                @foreach($users as $user)
                                    <option
                                        value="{{ $user->id }}"
                                        @selected(old('assigned_to', $task->assigned_to) == $user->id)
                                    >
                                        {{ $user->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('assigned_to')
                                <div class="taskflow-task-form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Priority --}}
                        <div class="taskflow-task-form-group">

                            <label for="priority">
                                <i class="bi bi-flag"></i>

                                {{ app()->getLocale() === 'ar'
                                    ? 'الأولوية'
                                    : 'Priority' }}
                            </label>

                            <select
                                id="priority"
                                name="priority"
                            >

                                <option
                                    value="low"
                                    @selected(old('priority', $task->priority) === 'low')
                                >
                                    {{ app()->getLocale() === 'ar'
                                        ? 'منخفضة'
                                        : 'Low' }}
                                </option>

                                <option
                                    value="medium"
                                    @selected(old('priority', $task->priority) === 'medium')
                                >
                                    {{ app()->getLocale() === 'ar'
                                        ? 'متوسطة'
                                        : 'Medium' }}
                                </option>

                                <option
                                    value="high"
                                    @selected(old('priority', $task->priority) === 'high')
                                >
                                    {{ app()->getLocale() === 'ar'
                                        ? 'عالية'
                                        : 'High' }}
                                </option>

                            </select>

                            @error('priority')
                                <div class="taskflow-task-form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Status --}}
                        <div class="taskflow-task-form-group">

                            <label for="status">
                                <i class="bi bi-check2-circle"></i>

                                {{ app()->getLocale() === 'ar'
                                    ? 'الحالة'
                                    : 'Status' }}
                            </label>

                            <select
                                id="status"
                                name="status"
                            >

                                <option
                                    value="todo"
                                    @selected(old('status', $task->status) === 'todo')
                                >
                                    {{ app()->getLocale() === 'ar'
                                        ? 'قيد الانتظار'
                                        : 'To Do' }}
                                </option>

                                <option
                                    value="in_progress"
                                    @selected(old('status', $task->status) === 'in_progress')
                                >
                                    {{ app()->getLocale() === 'ar'
                                        ? 'قيد التنفيذ'
                                        : 'In Progress' }}
                                </option>

                                <option
                                    value="completed"
                                    @selected(old('status', $task->status) === 'completed')
                                >
                                    {{ app()->getLocale() === 'ar'
                                        ? 'مكتملة'
                                        : 'Completed' }}
                                </option>

                            </select>

                            @error('status')
                                <div class="taskflow-task-form-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- Due Date --}}
                    <div class="taskflow-task-form-group">

                        <label for="due_date">
                            <i class="bi bi-calendar3"></i>

                            {{ app()->getLocale() === 'ar'
                                ? 'موعد التسليم'
                                : 'Due Date' }}
                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                            value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                        >

                        @error('due_date')
                            <div class="taskflow-task-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Footer --}}
                    <div class="taskflow-task-form-footer">

                        <a
                            href="{{ route('tasks.show', $task) }}"
                            class="taskflow-task-form-cancel"
                        >
                            {{ app()->getLocale() === 'ar'
                                ? 'إلغاء'
                                : 'Cancel' }}
                        </a>

                        <button
                            type="submit"
                            class="taskflow-task-form-submit"
                        >
                            <i class="bi bi-check2-circle"></i>

                            {{ app()->getLocale() === 'ar'
                                ? 'حفظ التعديلات'
                                : 'Save Changes' }}
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>