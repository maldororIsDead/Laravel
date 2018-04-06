@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4 box-shadow h-md-250">
                    <div class="card-header">Профиль</div>
                    <div class="row">
                        <div class="col-md-4 ml-2">
                            <img class="card-img-right flex-auto d-none d-md-block"
                                 data-src="holder.js/200x250?theme=thumb"
                                 alt="Thumbnail [200x250]"
                                 style="width: 200px; height: 250px;"
                                 src="{{ ($user->photo) ? "../uploads/" . $user->photo : "data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1627cedd855%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1627cedd855%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2256.203125%22%20y%3D%22131%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"}} "
                                 data-holder-rendered="true">
                            <form action="{{route('photo.upload', $user->id) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="photo">Добавить фото</label>
                                    <input type="file" id="photo" name="photo"/>
                                    <button type="submit" class="btn btn-primary btn-sm d-block mt-1">Добавить фото
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-md-around">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td>Имя</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Фамилия</td>
                                    <td>{{ $user->surname }}</td>
                                </tr>
                                <tr>
                                    <td>Отчество</td>
                                    <td>{{ $user->patronymic }}</td>
                                </tr>
                                <tr>
                                    <td>email</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Роль</td>
                                    <td>{{ $user->role }}</td>
                                </tr>
                                <tr>
                                    <td>Дата регистрации</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                            @if (Auth::user()->isCompany())
                                <div class="row d-flex justify-content-md-around">
                                    <a class="btn btn-primary d-block" href="{{ route('vacancies.index', $user->id)  }}"
                                       role="button">Просмотр вакансий</a>
                                    <a class="btn btn-success d-block"
                                       href="{{ route('vacancies.create', $user->id)  }}"
                                       role="button">Создать вакансию</a>
                                </div>
                            @else
                                <div class="row d-flex justify-content-md-around">
                                    <a class="btn btn-primary d-block" href="{{ route('resume.index', $user->id)  }}"
                                       role="button">Мои резюме</a>
                                    <a class="btn btn-success d-block" href="{{ route('resume.create', $user->id)  }}"
                                       role="button">Создать резюме</a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
