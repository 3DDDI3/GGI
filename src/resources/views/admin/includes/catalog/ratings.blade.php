@if (!empty($object->id) && !empty($ratings))
    <x-Admin.Accordion title="Рейтинги">

        <div class="average-rating-status" style="margin: 3px 0 10px;">
            {!! \App\Helpers\GenerateForm::makeCheckbox('custom_average_review_rating_status', $object->custom_average_review_rating_status , 'Ручная настройка рейтинга товара') !!}
        </div>
        <div class="average-rating-input" style="display: {{$object->custom_average_review_rating_status ? 'block' : 'none'}};">
            @include('admin.includes.input', ['label' => 'Оценка (голоса, GaGaРейтинг, например 5.0):', 'name' => 'average_review_rating', 'value' => $object->average_review_rating ?? '', 'class'=>'input-number-rating'])
        </div>

        @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки по умолчанию):', 'name' => 'rating', 'value' => $object->rating ?? '', 'class'=>'input-number'])

        @if (!empty($ratings))
            @foreach ($ratings AS $rating)
                @php
                    $rating_id = $rating->id ?? 0;
                    $label = $rating->name.':';
                    $info = @$catalog_ratings[$rating->id];
                    $rating_world = $info->rating_world ?? '';
                    $rating_local = $info->rating_local ?? '';
                    $rating_text = $info->text ?? '';
                    $rating_show = $info->rating_show ?? '';
                @endphp

                <fieldset class="fieldset-rating">
                    <legend>
                        @if (!empty($rating->main))
                            <strong>
                                {{ $rating->name }}
                            </strong>
                        @else
                            {{ $rating->name }}
                        @endif
                    </legend>

                    @include('admin.includes.checkbox', ['label'=>'Показывать товар на странице этого рейтинга', 'name'=>'rating_show'.$rating_id, 'value'=>$rating_show ?? ''])

                    @include('admin.includes.input', [
                        'label' => 'Мировой рейтинг:',
                        'name' => 'rating_world'.$rating_id,
                        'value' => $rating_world,
                        'class' => 'input-number-rating'
                    ])

                    @include('admin.includes.input', [
                        'label' => 'Рейтинг продаж:',
                        'name' => 'rating_local'.$rating_id,
                        'value' => $rating_local,
                        'class' => 'input-number-rating'
                    ])

                    @include('admin.includes.textbox', ['label'=>'Описание:', 'name'=>'rating_text'.$rating_id, 'value'=>$rating_text ?? ''])
                </fieldset>
            @endforeach
        @endif
    </x-Admin.Accordion>
@endif
