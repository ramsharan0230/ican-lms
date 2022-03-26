@extends('layouts.super-admin.master')
@section('title', 'Test Result')
@push('styles')
<link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
@endpush
@section('content')

<div class="pagetitle">
    <h1>
        <span class="text-semibold">Test Result</span>
    </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('super-admin-dashboard') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('courses.index')}}">Courses List</a></li>
        <li class="breadcrumb-item active">Test Result</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  {{-- new datatable-column-search-inputs --}}
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-9">
                <h3 class="card-title">
                    <span class="text-semibold">Test Result</span>
                </h3>
              </div>
              <div class="col-sm-3">
                <a class="btn btn-primary btn-sm" href="{{ url()->previous() }}"><i class="bi bi-arrow-left-circle"></i> Go Back</a>
              </div>
            </div>

          </div>
          <div class="card-body">
            <div class="panel-body">
                {{-- @include('flash-messages.partial_flash_alert_message') --}}
                @if($test)
                    <div class="row">
                    <div class="col-md-12">
                        
                        <h1>Test: {{ $test->name }}</h1>
                        <p>Full Marks: {{ $test->full_marks }}</p>
                        <p>Pass Marks: {{ $test->pass_marks }}</p>
                        <p>Marks Obtained: {{ $obtainedMarks }}</p>
                        <p>Percentage: {{ $obtainedPercentage }}%</p>
                            Status: 
                            @if($test->pass_marks <= $obtainedMarks)
                                <p class="label label-success">Passed</p>
                            @else
                                <p class="label label-danger">Failed</p>
                            @endif
                    </div>
                    </div>
                    @if($test->pass_marks <= $obtainedMarks)
                        @if(Auth::user()->role_id == 1)
                        <a href="{{ route('e-learning.certificate', $result->id) }}" class="btn btn-danger"><i class="fa fa-file-text-o m-r-5"></i> Download Certificate</a>
                        @else
                            <a href="{{ route('e-learning.test.certificate', $result->id) }}" class="btn btn-danger"><i class="fa fa-file-text-o m-r-5"></i> Download Certificate</a>
                        @endif
                    @endif
                @endif
                
                <hr>

                <h3><em>Answers</em></h3>
                @if($answers)
                    @foreach ($answers as $key => $answer) 
                    <div class="answers">
                        <?php $question = App\Models\Question::findOrFail($key); ?> 
                        
                        <b>{{ $question->question_text }}</b>
                        @if($question->question_type !== 'true-false')
                            <?php $check = array_diff_key(unserialize($question->question_answer), $answer); ?>
                            <?php $results = array_intersect_key(unserialize($question->question_options), $answer)?>
                            @if(empty($check))
                                <span class="label label-success">Correct</span>
                            @else
                                <span class="label label-danger">Incorrect</span>
                            @endif
                            <div class="your_answer">
                                Your Answer: 
                                @foreach($results as $result) 
                                    <p>{{ $result }}</p> 
                                @endforeach
                            </div>
                        @else
                            @if(serialize($answer) == $question->question_answer)
                                <span class="label label-success">Correct</span>
                            @else
                                <span class="label lable-danger">Incorrect</span>
                            @endif
                            <div class="your_answer">
                                Your Answer: <p>{{ $answer }}</p> 
                            </div>
                        @endif
                    </div>
                    @endforeach
                @endif
            </div>  <!-- panel-body -->
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

@endsection