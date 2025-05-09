<script setup>
import StudentsList from '../Students/Index.vue';
import AttendanceIndex from '../Attendance/Index.vue';
import GradesTable from '../Gradeables/Index.vue';
import CourseAdminActions from './components/CourseAdminActions.vue';
import { usePage, Link } from '@inertiajs/vue3';

const isAdmin = usePage().props.auth.isAdmin;

const { course } = defineProps({
  course: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="row">
    <div class="col">
      <h1>{{ course.name }}</h1>
      <p>{{ course.description }}</p>
    </div>
    <div class="col-auto">
      <CourseAdminActions v-if="isAdmin" :course="course" />
    </div>
  </div>

  <ul id="courseTabs" class="nav nav-tabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button
        id="students-tab"
        class="nav-link active"
        data-bs-toggle="tab"
        data-bs-target="#students-tab-pane"
        type="button"
        role="tab"
        aria-controls="students-tab-pane"
        aria-selected="true"
      >
        {{ $t('students') }}
      </button>
    </li>

    <li class="nav-item" role="presentation">
      <button
        id="exercises-tab"
        class="nav-link"
        data-bs-toggle="tab"
        data-bs-target="#exercises-tab-pane"
        type="button"
        role="tab"
        aria-controls="exercises-tab-pane"
        aria-selected="false"
      >
        {{ $t('exercises') }}
      </button>
    </li>

    <li class="nav-item" role="presentation">
      <button
        id="grades-tab"
        class="nav-link"
        data-bs-toggle="tab"
        data-bs-target="#grades-tab-pane"
        type="button"
        role="tab"
        aria-controls="grades-tab-pane"
        aria-selected="false"
      >
        {{ $t('grades') }}
      </button>
    </li>

    <li class="nav-item" role="presentation">
      <button
        id="attendance-tab"
        class="nav-link"
        data-bs-toggle="tab"
        data-bs-target="#attendance-tab-pane"
        type="button"
        role="tab"
        aria-controls="attendance-tab-pane"
        aria-selected="false"
      >
        {{ $t('attendances') }}
      </button>
    </li>
  </ul>

  <div id="courseTabsContent" class="tab-content p-3">
    <div
      id="students-tab-pane"
      class="tab-pane fade show active"
      role="tabpanel"
      aria-labelledby="students-tab"
      tabindex="0"
    >
      <StudentsList :students="course.students" />
    </div>

    <div
      id="exercises-tab-pane"
      class="tab-pane fade"
      role="tabpanel"
      aria-labelledby="exercises-tab"
      tabindex="0"
    >
      <h2 class="mb-3">{{ $t('exercises') }}</h2>
      <ul class="list-group">
        <li
          v-for="exercise in course.exercises"
          :key="exercise.id"
          class="list-group-item"
        >
          <span class="lead me-3">{{ exercise.title }}</span>
          <span class="text-muted"
            >Due Date:
            {{ new Date(exercise.assessment.due_at).toLocaleString() }}</span
          >
        </li>
      </ul>
    </div>

    <div
      id="grades-tab-pane"
      class="tab-pane fade"
      role="tabpanel"
      aria-labelledby="grades-tab"
      tabindex="0"
    >
      <GradesTable :students="course.students" :exercises="course.exercises" />
      <Link :href="`/courses/${course.id}/batchGrade`">
        {{ $t('grades.batch_add') }}
      </Link>
    </div>

    <div
      id="attendance-tab-pane"
      class="tab-pane fade"
      role="tabpanel"
      aria-labelledby="attendance-tab"
      tabindex="0"
    >
      <AttendanceIndex
        :students="course.students"
        :attendances="course.attendances"
      />
    </div>
  </div>
</template>
