<x-app-layout>

    <div class="taskflow-project-form container-fluid py-4">

        <div class="taskflow-project-form-header">

            <div>
                <div class="taskflow-project-form-eyebrow">
                    <i class="bi bi-pencil-square"></i>
                    {{ app()->getLocale() === 'ar' ? 'إدارة المشروعات' : 'PROJECT MANAGEMENT' }}
                </div>

                <h1>
                    {{ app()->getLocale() === 'ar' ? 'تعديل المشروع' : 'Edit Project' }}
                </h1>

                <p>
                    {{ app()->getLocale() === 'ar'
                        ? 'حدّثي بيانات المشروع وحافظي على معلوماته بشكل منظم.'
                        : 'Update your project information and keep everything organized.' }}
                </p>
            </div>

            <a
                href="{{ route('projects.show', $project) }}"
                class="taskflow-project-form-back"
            >
                <i class="bi bi-arrow-left"></i>

                <span>
                    {{ app()->getLocale() === 'ar' ? 'العودة للمشروع' : 'Back to Project' }}
                </span>
            </a>

        </div>


        <div class="taskflow-project-form-card">

            <div class="taskflow-project-form-card-header">

                <div class="taskflow-project-form-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <div>
                    <h2>
                        {{ app()->getLocale() === 'ar' ? 'بيانات المشروع' : 'Project Information' }}
                    </h2>

                    <p>
                        {{ app()->getLocale() === 'ar'
                            ? 'عدّلي البيانات التي تريدين تحديثها.'
                            : 'Update the information you want to change.' }}
                    </p>
                </div>

            </div>


            <form
                method="POST"
                action="{{ route('projects.update', $project) }}"
                class="taskflow-project-form-body"
            >

                @csrf
                @method('PUT')


                <div class="taskflow-project-form-group">

                    <label for="name">
                        <i class="bi bi-type"></i>

                        {{ app()->getLocale() === 'ar'
                            ? 'اسم المشروع'
                            : 'Project Name' }}
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $project->name) }}"
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

                            {{ app()->getLocale() === 'ar'
                                ? 'الوصف بالعربية'
                                : 'Arabic Description' }}
                        </label>

                        <textarea
                            id="description_ar"
                            name="description_ar"
                            rows="6"
                            dir="rtl"
                        >{{ old('description_ar', $project->description_ar) }}</textarea>

                        @error('description_ar')
                            <div class="taskflow-project-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="taskflow-project-form-group">

                        <label for="description_en">
                            <i class="bi bi-translate"></i>

                            {{ app()->getLocale() === 'ar'
                                ? 'الوصف بالإنجليزية'
                                : 'English Description' }}
                        </label>

                        <textarea
                            id="description_en"
                            name="description_en"
                            rows="6"
                            dir="ltr"
                        >{{ old('description_en', $project->description_en) }}</textarea>

                        @error('description_en')
                            <div class="taskflow-project-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="taskflow-project-form-footer">

                    <a
                        href="{{ route('projects.show', $project) }}"
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
                                ? 'حفظ التعديلات'
                                : 'Save Changes' }}
                        </span>
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
