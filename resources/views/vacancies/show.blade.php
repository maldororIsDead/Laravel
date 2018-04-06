@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row justify-content-between mt-1 mb-3">
                                <div class="col-md-3">
                                    <a class="btn btn-outline-secondary" href="{{ route('vacancies.index', Auth::user()->id) }}"
                                       role="button">Назад</a>
                                </div>
                                <div class="col-md-3">
                                    <a class="btn btn-outline-success" href="{{ route('vacancies.create', Auth::user()->id) }}"
                                       role="button">Создать вакансию</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row flex-md-row justify-content-start ml-1">
                            <div class="col-md-8">
                                <div class="d-flex justify-content-md-start mb-3">
                                    <span>Вакансия от {{ date( "d.m.Y", strtotime($vacancy->updated_at) ) }}</span>
                                </div>
                                <h2 class="card-title"> {{ $vacancy->title }}</h2>
                                <p class="card-text">{{ $vacancy->salary }}</p>
                                <div class="mb-3 d-flex justify-content-md-start">
                                    <div class="d-inline-block mr-5">
                                        <p>Компания:</p>
                                        <p>Город:</p>
                                        <p>Вид занятости:</p>
                                        <p>Контактное лицо:</p>
                                        <p>Телефон:</p>
                                    </div>
                                    <div class="d-inline-block">
                                        <p>{{ $vacancy->company }}</p>
                                        <p>{{ $vacancy->city }}</p>
                                        <p>{{ $vacancy->employment_type }}</p>
                                        <p>{{ $vacancy->contact_name }}</p>
                                        <p>{{ $vacancy->phone }}</p>
                                    </div>
                                </div>
                                <h4>Требования к вакансии</h4>
                                <p class="card-text">{{ $vacancy->requirements }}</p>
                                <h4>Дополнительная информация</h4>
                                <p class="card-text">{{ $vacancy->description }}</p>
                            </div>
                            <div class="col-md-4">
                                <img class="card-img-right flex-auto d-none d-md-block"
                                     data-src="holder.js/200x250?theme=thumb"
                                     alt="Thumbnail [200x250]"
                                     style="width: 200px; height: 250px;"
                                     src="{{ ($vacancy->user->photo) ? "../uploads/" . $vacancy->user->photo : "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1627cedd855%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1627cedd855%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.203125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"}} " data-holder-rendered="true">
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-around mt-3 mb-3">
                            <div class="col-md-3">
                                <a class="btn btn-success" href="{{ route('vacancies.edit', $vacancy->id) }}" role="button">Редактировать</a>
                            </div>
                            <div class="col-md-3">
                                <a class="btn btn-success" href="{{ route('receive-resumes', $vacancy->id) }}" role="button">Просмотреть резюме</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
