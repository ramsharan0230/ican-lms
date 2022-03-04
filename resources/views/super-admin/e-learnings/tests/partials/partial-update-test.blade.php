@section('additional-theme-js')
    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/media/fancybox.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/user_pages_team.js')}}"></script>
    {{-- // <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/custom/ckeditor/ckeditor.js') }}"></script>
    <!-- /theme JS files -->
@endsection

<div class="panel panel-flat">
    <div class="panel-body">
        <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="active"><a href="#bottom-tab1" data-toggle="tab">Tests</a></li>
                @if($is_create_method != "yes")
                    <li><a href="#bottom-tab2" data-toggle="tab">Questions</a></li>
                @endif
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="bottom-tab1">

                    <div class="panel-heading">
                        <h5 class="panel-title"><i class="icon-reading position-left"></i> Add Test</h5>
                    </div>

                    <div class="panel-body">
                        <div class="row add-new">
                            <div class="col-md-12">
                            {!! Form::model($test, ['method' => 'PATCH', 'route' => ['e-learning.tests.update', $test->id] ]) !!}
                            <div class="form-group">
                                <label for="name">Name</label>
                                {!! Form::text('name', null, ['placeholder' => 'Enter Test Name', 'class' =>
                                'form-control']) !!}
                            </div>
                        
                            <div class="form-group">
                                <label for="lesson_id">Choose Related Lesson</label>
                                {!! Form::select('lesson_id', $lessons, null, ['class' => 'select-search']) !!}
                            </div>

                            <div class="form-group">
                                <label for="duration">Duration in Minutes <span class="text-warning">(0 For No Limit)</span></label>
                                {!! Form::input('number', 'duration', null, ['class' => 'form-control',
                                'placeholder' => 'Enter Test
                                Duration in minutes']) !!}
                            </div>

                            <div class="form-group">
                                <label for="repetition">Test Repetitions <span class="text-warning">(0 For Unlimited)</span></label>
                                {!! Form::input('number', 'repetition', null, ['class' => 'form-control',
                                'placeholder' => 'Enter
                                Test Repetition Times']) !!}
                            </div>

                            <div class="form-group">
                                <label for="full_marks">Full Marks</label>
                                {!! Form::input('number', 'full_marks', null, ['class' => 'form-control',
                                'placeholder'=>'Enter Full
                                Marks']) !!}
                            </div>

                            <div class="form-group">
                                <label for="pass_marks">Pass Marks</label>
                                {!! Form::input('number', 'pass_marks', null, ['class' => 'form-control',
                                'placeholder'=>'Enter Pass
                                Marks']) !!}
                            </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="published_status">Published</label>
                                    </br>
                                    <label class="radio-inline m-t-5">
                                        {{ Form::radio('published_status', 1, ['class' => 'control-info', 'checked']) }} Yes
                                    </label>
                                    <label class="radio-inline m-t-5">
                                        {{ Form::radio('published_status', 0, ['class' => 'control-info']) }} No
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="shuffle_questions">Shuffle Questions </label>
                                    </br>
                                    <label class="radio-inline m-t-5">
                                        {{ Form::radio('shuffle_questions', 1, ['class' => 'control-info', 'checked']) }} Yes
                                    </label>
                                    <label class="radio-inline m-t-5">
                                        {{ Form::radio('shuffle_questions', 0, ['class' => 'control-info']) }} No
                                    </label>
                                </div>
                            </div>

                        </div>
                        <!-- row -->

                        <div class="form-group">
                            <label for="student_role_id">Description</label>

                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 5, 'id' =>
                            'add-test-description']) !!}
                        </div>
                        <!-- readmoreinfo -->
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Save <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                        {{ Form::close() }}
                    </div>

                </div>
                <!-- 1st tab finishes here -->
                @if($is_create_method != "yes")
                    
                    @include('super-admin.e-learnings.tests.partials.modal_true_false_fields')
                    @include('super-admin.e-learnings.tests.partials.modal_multiple_select_single')
                    @include('super-admin.e-learnings.tests.partials.modal_multiple_select_multiple')

                    <div class="tab-pane" id="bottom-tab2">
                        <div class="table-responsive test-test">
                            <table class="table table-bordered table-striped custom-width datatable-column-search-selects">
                                <thead>
                                <tr>
                                    <th>Related Lesson</th>
                                    <th>Question Text</th>
                                    <!--<th style="min-width: 210px;">Selected</th>-->
                                </tr>
                                </thead>
                                <tbody id="test_questions_tbody">
                                @foreach($questions as $question)
                                    <tr>
                                        <td>{{ $question->lesson_name }}</td>
                                        <td>{{ $question->question_text }} </td>
                                        {{--<td id="select-question-{{ $question->id }}">--}}
                                           {{-- @if($question->Tests->contains($test->id)) --}}
                                                {{--<a href="#" class="select-question btn btn-danger custom-message" data-question="{{ $question->id }}" data-test="{{ $test->id }}" >Unselect</a>--}}
                                                <?php 
                                                    //$question_test = DB::table('question_test')->where('test_id', $test->id)->where('question_id', $question->id)->first();
                                                ?>
                                               {{-- @if($question_test->shuffle == 0)--}}
                                                    {{--<a href="#" id="shuffle-answer-{{ $question->id }}" class="shuffle-answer btn btn-default custom-message" data-question="{{ $question->id }}" data-test="{{ $test->id }}">Shuffle</a>--}}
                                               {{-- @else --}}
                                                   {{-- <a href="#" id="shuffle-answer-{{ $question->id }}" class="shuffle-answer btn btn-default custom-message" data-question="{{ $question->id }}" data-test="{{ $test->id }}">Unshuffle</a> --}}
                                               {{-- @endif --}}
                                           {{-- @else --}}
                                                {{--<a href="#" class="select-question btn btn-info custom-message" data-question="{{ $question->id }}" data-test="{{ $test->id }}">Select</a> --}}
                                           {{-- @endif --}}
                                        {{-- </td>--}}
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- 2nd tab finishes here -->
                @endif
            </div>
            <!-- tab-content -->
        </div>
        <!-- tabbable -->
    </div>
    <!-- panel body -->
</div>  <!-- panl flat -->

@section('additional-css')
<style>
    .modal-dialog {
        width: 1000px;
    }
</style>
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

    <script type="text/javascript" src="{{ asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/datatables_api.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/extension_blockui.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/custom/js/custom-checkboxes-radios.js') }}"></script>

    <script>

        $(document).on('click', '.select-question',  function (e) {
            e.preventDefault();
            var question_id = $(this).attr('data-question');
            var test_id = $(this).attr('data-test');

            var dataString = "question_id="+question_id+"&test_id="+test_id;
            
            $.ajax({
                type: "POST", 
                url: "{{ route('tests.select-question-toggle') }}", 
                data: dataString, 
                dataType: "json", 
                success: function (data) {
                    if(data.status == "added") {
                        var dataChange = '<a href="#" class="select-question btn btn-danger custom-message m-r-4" data-question="'+ question_id +'" data-test="'+ test_id +'">Unselect</a>';
                            dataChange += '<a href="#" id="shuffle-answer-'+ question_id +'" class="shuffle-answer btn btn-default custom-message" data-question="'+ question_id +'" data-test="'+ test_id +'">Shuffle</a>';
                    } else {
                        var dataChange = '<a href="#" class="select-question btn btn-info custom-message m-r-4" data-question="'+ question_id +'" data-test="'+ test_id +'">Select</a>';
                    }
                    $('#select-question-'+ question_id).html(dataChange);
                    // console.log(data);
                }
            });
            
            
        });

        $(document).on('click', '.shuffle-answer', function (e) {
            e.preventDefault();
            var question_id = $(this).attr('data-question');
            var test_id = $(this).attr('data-test');
            
            var dataString = "question_id="+ question_id + "&test_id="+ test_id;
            var dataChange = '';
            $.ajax({
                type: "POST", 
                url: "{{ route('e-learning.tests.shuffle-answer') }}", 
                data: dataString, 
                dataType: "json", 
                success: function (data) {
                    console.log(data);
                    if(data.status == "shuffled") {
                        dataChange = "Unshuffle";
                    } else {
                        dataChange = "Shuffle";
                    }
                    $('#shuffle-answer-'+ question_id).html(dataChange);

                }
            })
        });
    </script>

    <!-- Multiple Select Single -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('.tbContainer input[type=radio]').click(function (event) {
                $('.tbContainer input[type=radio]').prop('checked', false);
                $(this).prop('checked', true);
            });
        });

        $(document).ready(function() {

            var $addInput = $('a.addSingleInput');
            $addInput.on("click", function(e) {
                e.preventDefault();
                var $this = $(this);
                var $lastTbContainer = $this.closest('.fieldsGroup').children('.tbContainer:last');

                var num = parseInt( $lastTbContainer.prop("id").match(/\d+/g), 10 ) +1;
                // console.log(num);

                var $clone = $lastTbContainer.clone().prop('id', num);
                $clone.find('button').removeClass('hidden');
                $clone.find('input:radio').prop('name', 'question_answer[' + num + ']');
                $clone.find('input:text').val('').prop('name', 'question_options[]');
                $lastTbContainer.after($clone);
            });
        });

        $('.fieldsGroup').on('click', 'button.remove', function() {
            $(this).closest('.tbContainer').remove();
        });
    </script>

    <!-- Multiple Select Multiple -->
        <script type="text/javascript">
        $(document).ready(function() {

            var $addInput = $('a.addMultipleInput');
            $addInput.on("click", function(e) {
                e.preventDefault();
                var $this = $(this);
                var $lastTbContainer = $this.closest('.fieldsGroup').children('.tbContainer:last');

                //var $div = $('div[class^="tbContainer"]:last');
                var num = parseInt( $lastTbContainer.prop("id").match(/\d+/g), 10 ) +1;
                console.log(num);

                var $clone = $lastTbContainer.clone().prop('id', num);
                $clone.find('button').removeClass('hidden');
                $clone.find('input:checkbox').prop('name', 'question_answer[' + num + ']');
                // $clone.find('input:hidden').prop('name', 'question_answer[' + num + ']');
                $clone.find('input:text').val('').prop('name', 'question_options[]');
                $lastTbContainer.after($clone);
            });
        });

        $('.fieldsGroup').on('click', 'button.remove', function() {
            $(this).closest('.tbContainer').remove();
        });
    </script>

    <script>
        $('#true_false_form').submit(function(e) {
            e.preventDefault();
            var test_id = {{ $test ? $test->id : '' }};
            
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'), 
                data: $(this).serialize(), 
                dataType: "JSON", 
                success: function (data) {
                    console.log(data);
                    var dataInsert = '<tr>'+
                            '<td>'+ data.lesson_name +'</td>'+
                            '<td>'+ data.question.question_text +'</td>'+
                            '<td id="select-question-'+ data.question.id +'">'+
                                '<a href="#" class="select-question btn btn-info custom-message" data-question="'+ data.question.id +'" data-test="'+ test_id +'">Select</a>'+
                        '</tr>';

                    $('#test_questions_tbody').prepend(dataInsert);
                }
            });
            
            $('#true_false_question').modal('hide');
        });

        $('#multiple_select_single_form').submit(function(e) {
            e.preventDefault();
            var test_id = {{ $test ? $test->id : '' }};

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'), 
                data: $(this).serialize(), 
                dataType: "JSON", 
                success: function(data) {
                    console.log(data);

                    var dataInsert = '<tr>'+
                            '<td>'+ data.lesson_name +'</td>'+
                            '<td>'+ data.question.question_text +'</td>'+
                            '<td id="select-question-'+ data.question.id +'">'+
                                '<a href="#" class="select-question btn btn-info custom-message" data-question="'+ data.question.id +'" data-test="'+ test_id +'">Select</a>'+
                        '</tr>';
                    $('#test_questions_tbody').prepend(dataInsert);
                }
            });

            $('#single_select_question').modal('hide');
           
        });

        $('#multiple_select_multiple_form').submit(function(e) {
            e.preventDefault();
            var test_id = {{ $test ? $test->id : '' }};

            $.ajax({
                type: $(this).attr('method'), 
                url: $(this).attr('action'), 
                data: $(this). serialize(),
                dataType: "JSON", 
                success: function (data) {
                    console.log(data);

                    var dataInsert = '<tr>'+
                            '<td>'+ data.lesson_name +'</td>'+
                            '<td>'+ data.question.question_text +'</td>'+
                            '<td id="select-question-'+ data.question.id +'">'+
                                '<a href="#" class="select-question btn btn-info custom-message" data-question="'+ data.question.id +'" data-test="'+ test_id +'">Select</a>'+
                        '</tr>';
                    $('#test_questions_tbody').prepend(dataInsert);
                }
            });
            $('#multiple_choice_question').modal('hide');

        });

    </script>

    

@endsection