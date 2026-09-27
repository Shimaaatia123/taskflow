<x-app-layout>

    <div class="taskflow-project-form container-fluid py-4">

        <div class="taskflow-project-form-header mb-4">

            <div>
                <div class="taskflow-project-form-eyebrow">
                    <i class="bi bi-kanban"></i>
                    {{ app()->getLocale() === 'ar' ? 'إدارة المشروعات' : 'PROJECT MANAGEMENT' }}
                </div>

                <h1>
                    {{ app()->getLocale() === 'ar' ? 'إنشاء مشروع جديد' : 'Create New Project' }}
                </h1>

                <p>
                    {{ app()->getLocale() === 'ar'
                        ? 'أضيفي المعلومات الأساسية للمشروع للبدء في تنظيم المهام والعمل.'
                        : 'Add the basic project information to start organizing tasks and work.' }}
                </p>
            </div>

            <a
                href="{{ route('projects.index') }}"
                class="taskflow-project-form-back"
            >
                <i class="bi bi-arrow-left"></i>
                <span>
                    {{ app()->getLocale() === 'ar' ? 'العودة للمشروعات' : 'Back to Projects' }}
                </span>
            </a>

        </div>


        <div class="taskflow-project-form-card">

            <div class="taskflow-project-form-card-header">

                <div class="taskflow-project-form-icon">
                    <i class="bi bi-folder-plus"></i>
                </div>

                <div>
                    <h2>
                        {{ app()->getLocale() === 'ar' ? 'بيانات المشروع' : 'Project Information' }}
                    </h2>

                    <p>
                        {{ app()->getLocale() === 'ar'
                            ? 'أدخلي البيانات المطلوبة لإنشاء المشروع.'
                            : 'Enter the required information to create your project.' }}
                    </p>
                </div>

            </div>


            <form
                method="POST"
                action="{{ route('projects.store') }}"
                class="taskflow-project-form-body"
            >

                @csrf


                <div class="taskflow-project-form-group">

                    <label for="name">
                        <i class="bi bi-type"></i>
                        {{ app()->getLocale() === 'ar' ? 'اسم المشروع' : 'Project Name' }}
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="{{ app()->getLocale() === 'ar'
                            ? 'مثال: تطوير موقع الشركة'
                            : 'Example: Company Website Development' }}"
                        autocomplete="off"
                        required
                    >

                    @error('name')
                        <div class="taskflow-project-form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="taskflow-project-form-grid">

                    <div class="taskflow-project-form-group">

                        <label for="description_ar">
                            <i class="bi bi-translate"></i>
                            {{ app()->getLocale() === 'ar' ? 'الوصف بالعربية' : 'Arabic Description' }}
                        </label>

                        <textarea
                            id="description_ar"
                            dir="rtl"                            
                            name="description_ar"
                            rows="6"
                            placeholder="{{ app()->getLocale() === 'ar'
                                ? 'اكتبي وصفًا مختصرًا للمشروع...'
                                : 'Write a short project description...' }}"
                        >{{ old('description_ar') }}</textarea>

                        @error('description_ar')
                            <div class="taskflow-project-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="taskflow-project-form-group">

                        <label for="description_en">
                            <i class="bi bi-translate"></i>
                            {{ app()->getLocale() === 'ar' ? 'الوصف بالإنجليزية' : 'English Description' }}
                        </label>

                        <textarea
                            id="description_en"
                            dir="ltr"
                            name="description_en"
                            rows="6"
                            placeholder="{{ app()->getLocale() === 'ar'
                                ? 'اكتبي الوصف باللغة الإنجليزية...'
                                : 'Write the project description in English...' }}"
                        >{{ old('description_en') }}</textarea>

                        @error('description_en')
                            <div class="taskflow-project-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="taskflow-project-form-footer">

                    <a
                        href="{{ route('projects.index') }}"
                        class="taskflow-project-form-cancel"
                    >
                        {{ app()->getLocale() === 'ar' ? 'إلغاء' : 'Cancel' }}
                    </a>

                    <button
                        type="submit"
                        class="taskflow-project-form-submit"
                    >
                        <i class="bi bi-check2-circle"></i>

                        <span>
                            {{ app()->getLocale() === 'ar'
                                ? 'إنشاء المشروع'
                                : 'Create Project' }}
                        </span>
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>