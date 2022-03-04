@extends('master-layouts.app-master-layouts.app-master-layout-super-admin')

@section('additional-theme-js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('assets/custom/js/custom-checkboxes-radios.js') }}"></script>
    <script type="text/javascript" src="assets/js/plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/user_pages_team.js"></script>
    <script type="text/javascript" src="assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/custom/ckeditor/ckeditor.js') }}"></script>
    <!-- /theme JS files -->
@endsection

@section('page-header')
    <div class="panel page-header page-header-xs border-bottom-teal">

        <div class="page-header-content">
            <div class="page-title">
                <h6>
                <span class="text-semibold">Test Result</span>
                <span class="pull-right custom-breadcrumb">

                     <ul class="breadcrumb">
                         <li><a href="{{ route('super-admin-dashboard') }}"><i class="icon-home2 position-left"></i> Home</a></li>
                         <li><a href="{{ route('e-learning.my-courses') }}">Courses List</a></li>
                         <li class="active">Test Result</li>
                     </ul>
                </span>
                </h6>
            </div>
            <div class="heading-elements">
                <a href="#" class="btn btn-primary btn-float btn-rounded heading-btn"><i
                            class="glyphicon glyphicon-edit"></i></a>
                <a href="#" class="btn btn-success btn-float btn-rounded heading-btn"><i class="icon-google-drive"></i></a>
                <a href="#" class="btn btn-info btn-float btn-rounded heading-btn"><i class="icon-twitter"></i></a>
            </div>
        </div>
    </div>
@endsection



@section('content')
    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-body">
            @include('flash-messages.partial_flash_alert_message')
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
        </div> <!-- panel -->
    </div>
@endsection

@section('additional-js-code')
    <script>
        var roxyFileman = '{{ asset('assets/custom/fileman/index.html') }}';
        $(function () {
            CKEDITOR.replace('add-test-description', {
                filebrowserBrowseUrl: roxyFileman,
                filebrowserImageBrowseUrl: roxyFileman + '?type=image',
                removeDialogTabs: 'link:upload;image:upload'
            });
        });
    </script>

    <script>
        $('.select-search').select2();    //to activate select drop down with search functionality...
    </script>

    <script type="text/javascript">
        $(document).ready(
                function () {
                    $("#readmoreinfo").hide();
                    $("#readmore").click(function () {
                        $("#readmoreinfo").toggle();
                    });
                });
    </script>

@endsection