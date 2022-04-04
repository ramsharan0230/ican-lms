<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('super-admin-dashboard') }}">
          <i class="bi bi-home"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">General</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('users.index') }}">
          <i class="bi bi-person"></i>
          <span>Users</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('roles.index') }}">
          <i class="bi bi-question-circle"></i>
          <span>Roles and Permissions</span>
        </a>
      </li><!-- End roles & permissions -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('terms.index')}}">
          <i class="bi bi-envelope"></i>
          <span>Terms and Conditions</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>e-Learning</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('categories.index') }}">
              <i class="bi bi-circle"></i><span>Categories</span>
            </a>
          </li>
          <li>
            <a href="{{ route('lessons.index') }}">
              <i class="bi bi-circle"></i><span>Lesson</span>
            </a>
          </li>
          <li>
            <a href="{{ route('courses.index')}}">
              <i class="bi bi-circle"></i><span>Courses</span>
            </a>
          </li>

          <li>
            <a href="{{ route('e-learning.questions.index')}}">
              <i class="bi bi-circle"></i><span>Questions</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('time_set.index') }}">
          <i class="bi bi-dash-circle"></i>
          <span>Time Set</span>
        </a>
      </li><!-- End Time Set Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav-report" data-bs-toggle="collapse" href="#">
          <i class="bi bi-list-columns"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav-report" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a class="nav-link collapsed" data-bs-target="#icons-nav-test-reports" data-bs-toggle="collapse" href="#">
              <i class="bi bi-pencil-square"></i><span>Test Reports</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav-test-reports" class="nav-content collapse " data-bs-parent="#icons-nav-report">

              <li>
                <a href="{{ route("e-learning.test-report.userwise") }}">
                  <i class="bi bi-card-list"></i><span>User Wise</span>
                </a>
              </li>
              <li>
                <a href="{{ route('e-learning.test-report.datewise') }}">
                  <i class="bi bi-card-text"></i><span>Date Wise</span>
                </a>
              </li>

            </ul>
          </li>

          @if(\Illuminate\Support\Facades\Auth::user()->role_id == 2)
          <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('course-orders.index') }}">
              <i class="bi bi-currency-dollar"></i> <span>Course Order Payments</span>
            </a>
          </li><!-- End Contact Page Nav -->

          <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('course-orders.failed-orders') }}">
              <i class="bi bi-currency-dollar"></i> <span>Failed Course Order Payments</span>
            </a>
          </li><!-- End Contact Page Nav -->

          <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('course-orders-cpe') }}">
              <i class="bi bi-currency-dollar"></i> <span>CPE Course Order Payments</span>
            </a>
          </li><!-- End Contact Page Nav -->

          @endif

          <li {!!(Route::currentRouteName()=="tests-taken")?'class="active"':''!!}>
            <a href="{{ route('tests-taken') }}"><i class="bi bi-list-task"></i> <span>Tests Taken</span></a>
          </li>
          <li {!!(Route::currentRouteName()=="tests-pass")?'class="active"':''!!}>
              <a href="{{ route('tests-pass') }}"><i class="bi bi-bookmark-check"></i> <span>Tests Passed</span></a>
          </li>
          <li {!!(Route::currentRouteName()=="tests-failed")?'class="active"':''!!}>
              <a href="{{ route('tests-failed') }}"><i class="bi bi-bookmark-x"></i> <span>Tests Failed</span></a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->
    </ul>

  </aside>