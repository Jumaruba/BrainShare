<div class="table-responsive w-100">
    
    @if (!empty($reports))
    <div class="table-entries">
        Showing {{$reports->perpage() * ($reports->currentpage()-1) + 1}} 
        to {{$reports->perpage() * ($reports->currentpage()-1) + $reports->count()}} 
        of {{$reports->total()}} entries
    </div>
    @endif

    <table class="table table-hover align-middle w-100">
        <thead >
            <tr>
                <th scope="col">#</th>
                <th scope="col">Type</th>
                <th scope="col">State</th>
                <th scope="col">Content</th>
                <th scope="col">Owner</th>
                <th scope="col">Description</th>
                <th scope="col">Reported By</th>
                <th scope="col">Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $report)
            <tr>
                <!-- Row number -->
                <th>{{$loop->index + 1 + $reports->perpage() * ($reports->currentpage()-1)}}</th>

                <!-- Report Type -->
                <td>
                    @if (isset($report->question_id) && $report->question_id)
                        Question
                    @elseif (isset($report->answer_id) && $report->answer_id) 
                        Answer
                    @elseif (isset($report->comment_id) && $report->comment_id) 
                        Comment
                    @else 
                        User
                    @endif
                </td>
                
                <!-- Report State -->
                <td>
                    @if ($report->viewed == true)
                        <i class="fas fa-check"></i>
                    @else
                        <i class="fas fa-exclamation"></i>
                    @endif
                </td>

                <!-- Reported Content -->
                <td>
                    <div class="d-flex align-items-center">
                        <!-- Question -->
                        @if (isset($report->question_id) && $report->question_id)
                            <a href="/question/{{$report->question_id}}" class="d-block m-auto">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        <!-- Answer -->
                        @elseif (isset($report->answer_id) && $report->answer_id) 
                            <a href="/question/{{$report->answer->question_id}}" class="d-block m-auto">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        <!-- Comment -->
                        @elseif (isset($report->comment_id) && $report->comment_id) 
                            <a href="/question/{{$report->comment->question_id}}" class="d-block m-auto">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        <!-- User -->
                        @else 
                            <a href="/user/{{$report->reported_id}}/profile" class="d-block m-auto">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        @endif
                    </div>
                </td>

                <!-- Reported Content Owner -->
                <td>
                    @if (isset($report->question_id) && $report->question_id)
                        <a href="/user/{{$report->question->question_owner_id}}/profile">
                            <span>{{$report->question->owner->username}}</span>
                        </a>
                    @elseif (isset($report->answer_id) && $report->answer_id) 
                        <a href="/user/{{$report->answer->answer_owner_id}}/profile">
                            <span>{{$report->answer->owner->username}}</span>
                        </a>
                    @elseif (isset($report->comment_id) && $report->comment_id) 
                        <a href="/user/{{$report->comment_owner_id}}/profile">
                            <span>{{$report->comment->owner->username}}</span>
                        </a>
                    @elseif (isset($report->reported_id) && $report->reported_id) 
                        <a href="/user/{{$report->reported_id}}/profile">
                            <span>{{$report->reported->username}}</span>
                        </a>
                    @else
                        <p>Deleted</p>
                    @endif
                </td>

                <!-- Report Description -->
                <td>
                    {{$report->content}}
                </td>

                <!-- Reported By -->
                <td>
                    <a href="/user/{{$report->user_id}}/profile">
                        <span>{{$report->owner->username}}</span>
                    </a>
                </td>

                <!-- Date -->
                <td>
                    {{ date('d-m-Y', strtotime($report->date)) }}
                </td>

                <!-- Actions -->
                <td>
                    @include('partials.management.reports.report-actions')
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>

    @if($reports->isEmpty())
        <span>No report found</span>
    @endif
</div>

<!-- Get pagination -->
{{ $reports->links() }}