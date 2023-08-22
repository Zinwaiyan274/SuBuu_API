<div class="responsive-table">
    <table class="table" id="erp-table">
        <thead>
            <tr>
                <th>{{__('#')}}</th>
                <th>{{__('Image')}}</th>
                <th>{{__('Quiz Name')}}</th>
                <th>{{__('Question')}}</th>
                <th>{{__('Answer')}}</th>
                <th>{{__('Status')}}</th>
                <th>{{__('Action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <img class="rounded-circle" height="45" width="45" src="{{ asset(file_exists($question->image) ? $question->image : 'back-end/img/icon/favicon.svg') }}" alt="">
                    </td>
                    <td>{{$question->questionCategory->name}}</td>
                    <td>{{$question->question}}</td>
                    <td>{{$question->answer}}</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input status-item" type="checkbox"  name="status_{{$question->id}}" id="status_{{$question->id}}" value="{{$question->status}}"  {{$question->status==1?'checked':''}} data-id ="{{$question->id}}" data-status="Question Status" >
                        </div>
                    </td>
                    <td>
                        <div class="dropdown table-action">
                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                <i class="far fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('edit-question', ['id' => $question->id]) }}"><i class="fal fa-pencil-alt"></i> {{ __('Edit') }} </a>
                                </li>
                                <li>
                                    <a href="{{ route('delete-question',$question->id) }}" class="confirm-action" data-method="DELETE">
                                        <i class="fal fa-trash-alt"></i>
                                        {{ __('Delete') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $questions->links() }}
