@extends('admin.app')
@section('content')

        @include('admin.includes.h1')


        <div class="admin_edit_block">

            @include('admin.includes.back')

            <form  method="post" enctype="multipart/form-data" class="admin_edit-form">
                @csrf

                @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name', 'value' => $object->name ?? '', 'required' => 'required'])

                {!! \App\Helpers\GenerateForm::makeFile('Файл', 'path' , $object , '/storage'.$object->path) !!}

                @include('admin.includes.input', ['label' => 'Рейтинг (для сортировки):', 'name' => 'rating', 'value' => $object->rating ?? ''])

               
                @if ($object->path)
                    <div class="input_block">
                        Ссылка на документ: <br/> 
                        {{-- <a href="{{route('document').'?path='.asset('storage'.$object->path)}}">{{route('document').'?path='.asset('storage'.$object->path)}}</a>
                        --}}
                        <a style="word-break: break-all" href="{{route('document').'?path='.asset('storage'.$object->path)}}">{!! route('document').'?path='.asset('storage'. preg_replace("/ /",'%20',$object->path)) !!}</a>
                    </div>
                @endif

                <x-Admin.Accordion title="Английская версия">
                    @include('admin.includes.input', ['label' => 'Название:', 'name' => 'name_en', 'value' => $object->name_en ?? ''])
                </x-Admin.Accordion>
                
                @include('admin.includes.errors')
                @include('admin.includes.submit')
            </form>
        </div>


@endsection